        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <?
        
        $file=fopen("Stats.txt","r") or exit("Kan ikke opne loggen desverre!");
        while (!feof($file)) { echo fgetc($file); }
        fclose($file);
        
        ?>