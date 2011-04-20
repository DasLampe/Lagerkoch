<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class dishModel extends basePage
{
	private $tplFolder;
		
	public function noEvent()
	{
		$this->tpl->vars("dishForm",		$this->dishForm());
		return $this->tpl->load("main",0, PATH_VIEW."dish/");
	}
	
	public function registered()
	{
		$dishes			= $this->getDish();
		
		$content		= '<ul>';
		foreach($dishes as $dish)
		{
			$content	.= '<li>';
			$content	.= $dish;
			$content	.= '</li>';
		}
		$content		.= '</ul>';
		
		$this->tpl->vars("headline",	"Eingetragene Gerichte");
		$this->tpl->vars("content",		$content);
		return $this->tpl->load("_standartContent");
	}
	
	public function dishForm()
	{
		$ingredient = "";
		for($i=0;$i<5;$i++)
		{
			$ingredient .= $this->tpl->load("_ingredient", 0, PATH_VIEW."dish/");
		}
		
		$this->tpl->vars("ingredient",	$ingredient);
		return $this->tpl->load("dishForm", 0, PATH_VIEW."dish/");
	}
	
	public function addIngredientInput()
	{
		return $this->tpl->load("_ingredient", 0, PATH_VIEW."dish/");
	}
	
	public function searchIngredient()
	{
		//Splitte Query, damit GET herrauskommt
		$request 	= explode("?", $_SERVER['REQUEST_URI'],2);
		$request	= explode("=", $request[1]);
		
		$db			= DB::getConnection();
		$result		= $db->prepare("SELECT id, name, price, unit, unit_price
									FROM ".MYSQL_PREFIX."zutaten
									WHERE name LIKE :name");
		$result->bindValue(":name", "%{$request[1]}%");
		$result->execute();
		
		
		$json		= "[";
		while($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			if($json != "[")
			{
				$json .= ',';
			}
			$json	.= '{';
			$json	.= '"id" : '.$row['id'].',';
			$json	.= '"label": "'.$row['name'].'",';
			$json	.= '"value" : "'.$row['name'].'",';
			$json	.= '"unitPrice" : "'.$this->readableUnit($row['unit']).'",';
			$json	.= '"price" : "'.round(($row['price'] * $this->readableUnit($row['unit'])), 2).'",';
			$json	.= '"unit" : "'.$row['unit'].'"';
			$json	.= '}';
		}
		$json		.= "]";
		
		return $json;
	}
	
	public function insertDish()
	{
		$db				= db::getConnection();
		$result			= $db->query("SELECT id, name
									FROM ".MYSQL_PREFIX."zutaten");
		$ingredientName	= $result->fetchAll(PDO::FETCH_ASSOC);

		$insert			= $db->prepare("INSERT INTO ".MYSQL_PREFIX."rezept
										(name)
										VALUES
										(:name)");
		$insert->bindValue(':name',		$_POST['dishName']);
		$insert->execute();
		
		$dishId			= $db->lastInsertId();
		
		for($i=0;$i<=5;$i++)
		{
			if(!empty($_POST['ingredientName'][$i]) && !empty($_POST['ingredientUnitPrice'][$i]) && !empty($_POST['ingredientPrice'][$i]))
			{
				if(!helper::in_multiarray($_POST['ingredientName'][$i], $ingredientName))
				{
					$price		= (str_replace(',', '.', $_POST['ingredientPrice'][$i]) / $_POST['ingredientUnitPrice'][$i]);
					$insert	= $db->prepare("INSERT INTO ".MYSQL_PREFIX."zutaten
											(name, unit, price)
											VALUES
											(:name, :unit, :price)");
					$insert->bindParam(':name',			$_POST['ingredientName'][$i]);
					$insert->bindParam(':unit',			$_POST['ingredientUnit'][$i]);
					$insert->bindParam(':price',		$price);
					$insert->execute();
					
					$ingredientName[]	= array(
												'id'	=> $db->lastInsertId(),
												'name'	=> $_POST['ingredientName'][$i],
												);
				}
				$key		= helper::array_searchRecursive($_POST['ingredientName'][$i], $ingredientName);
				$key		= $ingredientName[$key[0]]['id'];
				
				$insert		= $db->prepare("INSERT INTO ".MYSQL_PREFIX."rezeptZutaten
											(rezept_id, zutaten_id, unity)
											VALUES
											(:rezeptId, :zutatenId, :unity)");
				$insert->bindValue(':rezeptId',		$dishId);
				$insert->bindValue(':zutatenId',	$key);
				$insert->bindValue(':unity',		(str_replace(",", ".", $_POST['ingredientUnity'][$i]) / $_POST['dishPerson']));
				$insert->execute();
			}
			elseif(!empty($_POST['ingredientName'][$i]))
			{
				return '{ "status" : "Bitte alle Felder für die Zutat ausfüllen!" }';
			}
		}
		return '{ "status" : "Gericht wurde erfolgreich eingetragen!" }';
	}
	
	private function getDish()
	{
		$db			= db::getConnection();
		$return		= array();
		
		$result		= $db->query("SELECT rezept_id
								FROM ".MYSQL_PREFIX."rezeptZutaten
								GROUP BY rezept_id");
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$resultRezept	= $db->query("SELECT name
										FROM ".MYSQL_PREFIX."rezept
										WHERE id = '".$row['rezept_id']."'");
			$rowRezept		= $resultRezept->fetch(PDO::FETCH_ASSOC);
			$return[]		= $rowRezept['name'];
		}
		
		return $return;
	}
	
	private function readableUnit($unit)
	{
		switch($unit)
		{
			case 'g':
			case 'ml':
				return 100;
				break;
			case 'kg':
			case 'l':
			case 'Stück':
				return 1;
				break;
		}
	}
}