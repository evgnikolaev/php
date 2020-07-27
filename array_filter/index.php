<?

//https://www.youtube.com/watch?v=ZgAyS1dDaTI


/* 	array_filter() - как if по каждому элементу, фильтрует */
$arRes = [0, 1, 2, 33, '', 'text'];
$arr1 = array_filter($arRes);    //без callback, вернет только элементы true (убирает пустые, нулевае значения)
$arr2 = array_filter($arRes, function ($element) {
	return $element > 1;  //отфильтрует все элементы больше 1
});


/* 	array_map() - пройдет по каждому элементу, и с каждым что-то сделает, ДЛЯ ПРЕОБРАЗОВАНИЯ */
$number = 4;
$arr3 = array_map(function ($element) use ($number) { //при помощи use передаем переменную извне, замыкаем
	return $element + $number;
}, $arRes);  // вернет [4,5,6,37, 4, 4]

$arr4 = array_map('strtoupper', $arRes);  // в качестве callback можно передать стандартную ф-ию


/* 	array_walk() - пройдет по каждому элементу ДЛЯ ОБХОДА И ВЫВОДА */
$arr2 = array_walk($arRes, function ($element) {
	//return $element + $number;  //не сработает, не меняет исходный массив, вернет true/false, смог сделать или нет данную опреацию
	//echo $element;  // можем только вывести
});
?>