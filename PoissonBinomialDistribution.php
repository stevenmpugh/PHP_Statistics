class PoissonBinomialDistribution {

	// Functions T() and Pr() are from using the recursive formula referenced here:
	// https://en.wikipedia.org/wiki/Poisson_binomial_distribution
	private static function T($i, $n, $p)
	{
		$T = 0;
	
		for ($j=1; $j<=$n; $j++) 
		{
			$T = $T + pow(($p[$j-1]/(1-$p[$j-1])),$i);
		}
	
		return $T;
	}

	// Function returns Pr(X=x)
	public static function Pr($k, $n, $p)
	{	
		if ($k == 0)
		{
			$product = 1;
		
			for ($i=1; $i<=$n; $i++) 
			{
				$product = $product * (1-$p[$i-1]);
			}
		
			return $product;
		}
		else
		{
			$summation = 0;
		
			for ($i=1; $i<=$k; $i++) 
			{
				$T = self::T($i, $n, $p);
				$Pr = self::Pr($k-$i,$n,$p);
				$summation = $summation + pow(-1, $i-1)*$T*$Pr;
			}

			return $summation/$k;
		}
	}
}


// Testing
$pbd = new PoissonBinomialDistribution;

$p = array();
array_push($p, 0.2794);
array_push($p, 0.2995);
array_push($p, 0.0946);
array_push($p, 0.7314);
array_push($p, 0.7545);

$n = count($p);

for ($k=0; $k<=$n; $k++) 
{
	$Pr = $pbd->Pr($k, $n, $p);
	print("<br>The probability of $k successes in $n trials is $Pr");
}
