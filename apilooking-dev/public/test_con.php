<?php
// Config
$dbhost = '127.0.0.1';
$dbname = 'grubitnow';
 
// Connect to test database
$m = new Mongo("mongodb://$dbhost");
$db = $m->$dbname;
echo "Connection to database successfully"; 
// select the collection
$collection = $db->shows;
  echo "Database site selected";
// pull a cursor query
$cursor = $collection->find();


 
$collection = $db->createCollection("mycol");
   echo "Collection created succsessfully";
$collection = $db->mycol;
   echo "Collection selected succsessfully";
   $document = array( 
      "title" => "MongoDB", 
      "description" => "database", 
      "likes" => 10000,
      "url" => "http://www.tutorialspoint.com/mongodb/",
      "by", "tutorials point"
   );
   $collection->insert($document);

   echo "Document inserted successfully";
 $cursor = $collection->find();
 
   // iterate cursor to display title of documents
   foreach ($cursor as $document) {
      echo $document["likes"] . "\n";
   }
?>
