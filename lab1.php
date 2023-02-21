<?php require_once('header.php'); ?>
<style>
	.my-div {
	  width: 1000px;
	  height: 100px;
	  word-wrap: break-word;
	  white-space: normal;
	  margin: 0 auto;
	}

</style>

<?php 
$array = [
	"firstName" => "Armen",
	"lastName"  => "Hayrapetyan",
	"address" => [
		"streetAddress" => "Mkhchyan 119/3",
		"city" => "Artashat",
		"country" => "Armenia",
		"postalCode" => "3307",
	],
	"phoneNumbers" => [
		"37477611707",		
		"37477611703"		
	]
];

$jsonString = json_encode($array);
$base64String = base64_encode($jsonString);
$decodedString = base64_decode($base64String);
$array = json_decode($decodedString, true);

 ?>

<div class="my-div">
	<h1>Լաբորատոր առաջադրանք 1</h1>
	<p>Մտածում եք որեւէ տեղեկույթի համակարգված ներկայացման JSON
կառուցվածք (որոշակի իրական խնդրի համար)։ Կազմում եք այդ JSON կառուցվածքը,
ինչպես ներկայացված էր դասախոսության օրինակում։ Դրանից հետո Ձեզ հարմար
ծրագրավորման միջավայրում base64 կոդավորման ալգորիթմով կոդավորում եւ
այնուհետեւ ապակոդավորում եք այդ JSON ձեւաչափով որեւէ գրանցում։ Հարկավոր է
ոչ թե իրագործել base64-ալգորիթմը, այլ օգտագործել այդ ծրագրավորման լեզվի որեւէ
գրադարան։</p>

<ul>
	<li><h3>Source Array:</h3> <pre><?php print_r($array); ?></pre></li>
	<li><h3>Json string:   </h3><?php print_r($jsonString); ?></li>
	<li><h3>Base64 string:</h3> <?php print_r($base64String); ?></li>
	<li><h3>Decoded string:</h3><?php print_r($decodedString); ?></li>
</ul>
</div>