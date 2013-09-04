<!DOCTYPE HTML>
<html>
<head>
	<title>phaser.js - a new beginning</title>
	<?php
		require('js.php');
	?>
</head>
<body>

<script type="text/javascript">

(function () {

	var game = new Phaser.Game(800, 600, Phaser.CANVAS, '', { preload: preload, create: create, update: update, render: render });

	function preload() {
		game.load.image('ship', 'assets/sprites/xenon2_ship.png');
		game.load.image('baddie', 'assets/sprites/space-baddie.png');
	}

	var ship;
	var total;
	var aliens;

	function create() {

		aliens = [];

		for (var i = 0; i < 100; i++)
		{
			var s = game.add.sprite(game.world.randomX, game.world.randomY, 'baddie');
			s.body.collideWorldBounds = true;
			s.body.bounce.setTo(1, 1);
			s.body.velocity.setTo(10 + Math.random() * 10, 10 + Math.random() * 10);
			aliens.push(s);
		}

		ship = game.add.sprite(400, 400, 'ship');
		ship.body.collideWorldBounds = true;
		ship.body.bounce.setTo(0.5, 0.5);

	}

	function update() {

		for (var i = 0; i < aliens.length; i++)
		{
			aliens[i].alpha = 0.3;
		}

		total = game.physics.quadTree.retrieve(ship);

		for (var i = 0; i < total.length; i++)
		{
			total[i].sprite.alpha = 1;
		}

        if (game.input.keyboard.isDown(Phaser.Keyboard.LEFT))
        {
            ship.body.velocity.x -= 2;
        }
        else if (game.input.keyboard.isDown(Phaser.Keyboard.RIGHT))
        {
            ship.body.velocity.x += 2;
        }

        if (game.input.keyboard.isDown(Phaser.Keyboard.UP))
        {
            ship.body.velocity.y -= 2;
        }
        else if (game.input.keyboard.isDown(Phaser.Keyboard.DOWN))
        {
            ship.body.velocity.y += 2;
        }

	}

	function render() {

		for (var i = 0; i < aliens.length; i++)
		{
			game.debug.renderRectangle(aliens[i].bounds);
		}

		game.debug.renderText(total.length, 32, 32);
		game.debug.renderQuadTree(game.physics.quadTree);
		game.debug.renderRectangle(ship);

	}

})();

</script>

</body>
</html>