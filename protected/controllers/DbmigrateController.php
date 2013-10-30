<?php

/*
 * Yii Migration Tool v1.0 (based on Yii v1.1.13)
 */

class DbmigrateController extends Controller {
   public function actionIndex() {
      echo '<html><body style="background-color:black; color:white;"><div><pre>';
      $commandPath = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . 'commands';
      $runner = new CConsoleCommandRunner();
      $runner->addCommands($commandPath);
      $commandPath = Yii::getFrameworkPath() . DIRECTORY_SEPARATOR . 'cli' . DIRECTORY_SEPARATOR . 'commands';
      $runner->addCommands($commandPath);
      $args = array('yiic', 'migrate', '--interactive=0');
      ob_start();
      $runner->run($args);
      echo htmlentities(ob_get_clean(), null, Yii::app()->charset);
      echo '</pre></div></body></html>';
   }
}
