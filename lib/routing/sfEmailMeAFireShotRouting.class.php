<?php


/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Cedric Lombardot <cedric.lombardot@spyrit.net>
 */
class sfEmailMeAFireShotRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('sf_email_me_a_fireshot', new sfRoute('/sf_email_me_a_fireshot', array('module' => 'sfEmailMeAFireShot', 'action' => 'index')));
  }

}
