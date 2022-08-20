function isDivisibleBy(dividend, divisor) {
	return dividend % divisor == 0;
}

var sum = 0;
for (var i = 1; i < 1000; i++){
	//Check if the number is a multiple of 3 or 5 
	if (isDivisibleBy(i, 3) || isDivisibleBy(i, 5)) {
    	sum += i;
	}
}
console.log(sum);
document.write("The sum of all the multiples of 3 or 5 below one thousand is " + sum);
