<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('csDoctrineActAsSortablePlugin');

    /**
     * Configure the Mailer
     */
    $this->dispatcher->connect(
        'mailer.configure',
        array($this, 'configureMailer')
    );
  }

  /**
  * Configure the Doctrine engine
  **/
  public function configureDoctrine(Doctrine_Manager $manager)
  {
    $manager->setAttribute(Doctrine::ATTR_QUERY_CACHE, new Doctrine_Cache_Apc());
  }

  public function configureMailer(sfEvent $event)
  {
      //Sensible data here (passwords!)
      $sensible = sfYaml::load(sfConfig::get('sf_config_dir').'/sensible.yml');
      $mailer = $event->getSubject();
      $transport = $mailer->getRealtimeTransport();
      $transport->setPassword($sensible['mailPassword']);
      $mailer->setRealtimeTransport($transport);
  }
}
