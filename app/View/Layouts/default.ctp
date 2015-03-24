<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo Configure::read('systemDetails.sysName') ?>:
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array(
        'bootstrap.min',
        'bootstrap-theme.min',
        'style',
    ));

    echo $this->Html->script(array(
            'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js',
            'http://maps.google.com/maps/api/js?libraries=visualization&sensor=false',
            'scripts'
        )
    );

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>
<div id="container">
    <div id="header">
        <div class="row">
            <div class="col-sm-2">
                <?php echo $this->Html->image('logo.png', array(
                    'escape' => false,
                    'alt' => 'Currency Fair'
                )); ?>
            </div>
            <div class="col-sm-2" style="float: right">
                <span id="systemClock" class="clock"></span>
            </div>
        </div>
    </div>
    <div id="content">

        <?php echo $this->Session->flash(); ?>

        <?php echo $this->fetch('content'); ?>
    </div>
    <div id="footer" style="text-align: right">
        <span> <?php echo Configure::read('systemDetails.sysDetails'); ?>
		</span><span> <?php echo(' | ' . 'About' . ' | ' . Configure::version()); ?>
		</span>
    </div>

</div>
<script>
    renderTime();
</script>
</div>
</body>
</html>
