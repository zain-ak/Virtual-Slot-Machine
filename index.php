<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width="", initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Virtual Slot Machine</title>
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    <link rel="stylesheet" href="assets/style.css"/> 
</head>
<body bgcolor="blueviolet">
    <?php
        $credit = 0;
        $bet = 0;
        $status = "";
        $images = array("assets/img/apple.png", "assets/img/cherry.png", "assets/img/grapes.png", "assets/img/lemon.png", "assets/img/orange.png", "assets/img/pear.png", "assets/img/watermelon.png");
        $indices = array(-1, -1, -1);
        for ($i = 0; $i < sizeof($indices); $i++)
            $indices[$i] = $images[mt_rand(0, sizeof($images)-1)];

        if ($indices[0] ==  $indices[1] && $indices[0] == $indices[2]) {
            $credit = $_POST['credit'] += ($_POST['bet']*10);
            $status = "<h2 style='color: greenyellow;'>Jackpot! All fruits matched! You just won $" . ($_POST['bet']*10) . "!</h2>";
            $bet = 0;
        }
        else if ($indices[0] ==  $indices[1] || $indices[0] == $indices[2] || $indices[1] == $indices[2]) {
            $credit = $_POST['credit'] += ($_POST['bet']*2);
            $status = "<h2 style='color: yellow;'>Nice! 2 matching fruits means you just won $" . ($_POST['bet']*2) . "!</h2>";
            $bet = 0;
        }
        else {
            $status = "<h2 style='color: red;'> Aw Boo :( Your credit has gone down $" . $_POST['bet'] . "</h2>";
            $bet = 0;
            $credit = $_POST['credit'] - $_POST['bet'];
        }

        $userName = $_POST['userName'];
        if ($credit === 0) {
            $userName = "";
            $status = "<h2 style='color: orange;'>Welcome to a new game of THROW YOUR LIFE AWAY!<br>As soon as your credit goes to zero, the game restarts></h2>";
            $credit = 200;
        }
         
    ?>
    <h1 style="color:orange; font-size: 4em;">Virtual Slot Machine!</h1>
    <div class="slotContainer">
        <div class="imageBox"><img src=<?php echo $indices[0]; ?> height=250 width=250/></div>
        <div class="imageBox"><img src=<?php echo $indices[1];?> height=250 width=250/></div>
        <div class="imageBox"><img src=<?php echo $indices[2];?> height=250 width=250/></div>
        <input form="userForm" type="hidden" name="indexOne" value="<?php echo $indices[0] ?>">
        <input form="userForm" type="hidden" name="indexTwo" value="<?php echo $indices[1] ?>">
        <input form="userForm" type="hidden" name="indexThree" value="<?php echo $indices[2] ?>">
        <div class="spinBox"><input form="userForm" type="submit"name="btn" value="Spin!"></div>
    </div>

    <div class="userInfo">
        <?php echo  $status; ?>
        <form action="index.php" method="POST" id="userForm">
            <label for="userName">Name (Length: 4-15)</label>
            <input type="text" id="userName" name="userName" value="<?php echo $userName; ?>" minlength="4" maxlength="15" size="16" required ><br><br>
            <label style="margin-bottom: 10px;" for="bet">Your Bet (<= Credit)</label>
            <input style="margin-bottom: 10px;" type="number" id="bet" name="bet" size="4" min="1" max="<?php echo $credit; ?>" required><br>
            <label for="credit">Credit:</label>
            <input type="text" id="credit" name="credit" size="4" value="<?php echo $credit; ?>" readonly="true"><br>
        </form>
    </div>

    <!-- <div class="output"></div> FOR TESTING-->
</body>
</html>