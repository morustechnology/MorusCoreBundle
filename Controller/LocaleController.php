<?php

namespace Morus\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\RedirectResponse;

class LocaleController extends Controller
{
    public function panelAction()
    {
        return $this->render('MorusCoreBundle:Locale:panel.html.twig');
    }
    
    public function switchAction(Request $request, $locale)
    {
        $request->getSession()->set('_locale', $locale);
        
        $referer_url = $request->headers->get('referer');
        if ($referer_url)
            $url = $referer_url;
        else
            $url = $this->container->get('router')->generate('morus_core_locale_switched', array('locale' => $locale));
            
        return new RedirectResponse($url);
    }
    
    public function switchedAction($locale)
    {
        return $this->render('MorusCoreBundle:Locale:switched.html.twig', array('locale' => $locale));
    }
}
