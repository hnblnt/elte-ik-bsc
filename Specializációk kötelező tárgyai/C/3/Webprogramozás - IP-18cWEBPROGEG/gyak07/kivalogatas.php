<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        /*function filter($x)
        {
            foreach ($x as $elem) {
                if($elem < 0){
                        $result[] = $elem  ;  
                    }
            }
            return $result;
        };

        $numbers = [1,-8,3,4,-6,9];

        $negative = filter($numbers);
        print("<pre>");
        print_r($negative);
        print("</pre>");*/


        /*function filter($x, callable $fn)
        {
            foreach ($x as $elem) {
                if($fn($elem)){
                        $result[] = $elem  ;  
                    }
            }
            return $result;
        };

        $numbers = [1,-8,3,4,-6,9];

        $negative = filter($numbers,function($e)
            {
                return $e > 0;
            }
        );
        print("<pre>");
        print_r($negative);
        print("</pre>");*/

        /*$limit = 2  ;

        $numbers = [1,-8,3,4,-6,9];

        $negative = array_filter($numbers, function($elem) use ($limit)
        {
            return $elem < $limit;
        });
        print("<pre>");
        print_r($negative);
        print("</pre>");*/

        $limit = 2  ;

        $numbers = [1,-8,3,4,-6,9];

        $negative = array_filter($numbers, function($elem) use ($limit)
        {
            return $elem < $limit;
        });
        print("<pre>");
        print_r($negative);
        print("</pre>");
    ?>

    <ul>
        <?php foreach ($negative as $numbers) :  ?>
            <li><?= $numbers ?></li>
        <?php endforeach ?>
    </ul>
</body>
</html>