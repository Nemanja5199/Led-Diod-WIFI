<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LED Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .forma {
           
            margin: auto;
            width: 50%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Custom CSS for LED indicator */
        .led-indicator {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .led-indicator.blue {
            background-color: #007bff;
        }

        /* Artistic styles for text and button */
        .led-status {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
        }

        .toggle-button {
            padding: 15px 30px;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 4px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        .toggle-button:hover {
            background-color: #0056b3;
        }

        /* Rest of your CSS styles... */
    </style>





</head>
<body>




    <?php
    require_once '../Led/ControllerLed.php';

    $cs = new ControllerLed();

    $status = $cs->GetStatus();

    foreach ($status as $s) {
        $newStatus = $s["status"];
    }

    function Toggle($currentvalue) {
        $currentvalue = ($currentvalue == 0) ? '1' : '0';
        return $currentvalue;
    }
    ?>

    <div class="forma" id="refresh">
        <div class="led-status">LED Status</div>
        <div class="led-indicator <?php echo ($newStatus == '1') ? 'blue' : ''; ?>">
            <?php echo ($newStatus == '1') ? 'ON' : 'OFF'; ?>
        </div>
        <form action="../Led/" method="post">
            <input type="hidden" name="led_status" value=<?php echo Toggle($newStatus);?>>
            <button class="toggle-button" type="submit" name="action" value="Toggle">
                <?php echo ($newStatus == '1') ? 'Turn Off' : 'Turn On'; ?>
            </button>
        </form>

    </div>

    <script type="text/javascript">
			$(document).ready (function () {
				var updater = setTimeout (function () {
					$('div#refresh').load ('../view/pocetna.php', );
				}, 1000);
			});
			</script>



</body>
</html>
