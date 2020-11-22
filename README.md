
Um CRUD feito em PHP orientado a objetos para conexão com banco MYSQL, simulando um controle de produtos

## CONFIGURAÇÕES INICIAIS

**Database**

Você pode alterar os atributos da classe *mysql_crud.php* para apontar para o seu banco de dados-

```php
private $db_host = "localhost";  // Change as required
private $db_user = "username";  // Change as required
private $db_pass = "password";  // Change as required
private $db_name = "database";	// Change as required
```

** MySQL**

Crie a base de dados-

```mysql
CREATE TABLE `tabela` (
  `id` int(11) NOT NULL,
  `SKU` varchar(45) NOT NULL,
  `descricao` text DEFAULT NULL,
  `nome` varchar(45) NOT NULL,
  `valor` varchar(30) DEFAULT NULL,
  `peso` float DEFAULT NULL,
  primary key (id)
) 

```
## USANDO  A APLICAÇÂO  

**Select**

Use the following code to select * rows from the databse using this class

```php
<?php
include('class/mysql_crud.php');
$db = new Database();

$db->select('tabela'); // Table name
$res = $db->getResult();
print_r($res);
```

Use the following code to specify what is selected from the database using this class

```php
<?php
include('class/mysql_crud.php');
$db->connect();
$db->select('tabela','id,name','name="Name 1"','id DESC'); 
$res = $db->getResult();
print_r($res);
```

**Update Example**

Use the following code to update rows in the database using this class

```php
<?php
include('class/mysql_crud.php');
$db = new Database();
$db->update('tabela',array('name'=>"Name 4",'email'=>"name4@email.com"),'id="1" AND name="Name 1"'); // Table name, column names and values, WHERE conditions
$res = $db->getResult();
print_r($res);
```

**Insert Example**

Use the following code to insert rows into the database using this class

```php
<?php
include('class/mysql_crud.php');
$db = new Database();

$data = $db->escapeString("name5@email.com"); // Escape any input before insert
$db->insert('tabela',array('name'=>'Name 5','email'=>$data));  // Table name, column names and respective values
$res = $db->getResult();  
print_r($res);
```

**Delete Example**

Use the following code to delete rows from the database with this class

```php
<?php
include('class/mysql_crud.php');
$db = new Database();
$db->delete('tabela','id=5');  // Table name, WHERE conditions
$res = $db->getResult();  
print_r($res);
```

