<?php

/* ChristianSoronellasBlogBundle::layout.html.twig */
class __TwigTemplate_8e243e5a29b78537852f4083d5197bf4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = array();
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/christiansoronellasblog/css/style.css"), "html");
        echo "\" type=\"text/css\" media=\"screen\" />
        <!--[if lt IE 8]>
        <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/christiansoronellasblog/css/ie-fixes.css"), "html");
        echo "\" type=\"text/css\" media=\"screen\" />
        <![endif]-->
    </head>
    
    <body>
        <div id=\"wrapper\">\t
            <div id=\"header-wrapper\">
                <div id=\"nav\">
                    <ul>
                        <li class=\"page_item page-item-22\"><a href=\"#\">Me</a></li>
                    </ul>
                </div>
                <div id=\"header\">
                    <h1><a href=\"http://christian.soronellas.es\">christian.soronellas</a></h1>
                </div>
            </div>
            <hr />
            <div id=\"content\">
                ";
        // line 26
        $this->displayBlock('content', $context, $blocks);
        // line 28
        echo "            </div>
            <hr />
            <div id=\"sidebar\">
                <div class=\"section\">
                    <h2>About this blog</h2>
                    <p>Description</p>
                </div>
                <div class=\"section\">
                    <h2>Search</h2>
                    <p>Search form</p>
                </div>
            </div>
            <hr />
            <div id=\"footer\">
                <p>A theme by <a href=\"http://www.rodrigogalindez.com\" rel=\"nofolow\">Rodrigo Galindez</a></p>
            </div>
        </div>
        ";
        // line 45
        if (array_key_exists("code", $context)) {
            // line 46
            echo "        <h2>Code behind this page</h2>
        <div class=\"symfony-content\">";
            // line 47
            echo $this->getContext($context, 'code');
            echo "</div>
        ";
        }
        // line 49
        echo "        ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "f7a8c8f_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f7a8c8f_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f7a8c8f_LAB.min_1.js");
            // line 50
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\"></script>
        ";
        } else {
            // asset "f7a8c8f"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f7a8c8f") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f7a8c8f.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\"></script>
        ";
        }
        unset($context["asset_url"]);
        // line 52
        echo "        <script type=\"text/javascript\">
            // <![CDATA[
            \$LAB
            .script('https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js')
            .wait(function() {
                \$(window).load(function(event) {
                    \$('#nav li').each(function() {
                        \$(this).bind('mouseover', function() { this.className += ' sfhover'; })
                               .bind('mouseout' , function() { this.className=this.className.replace(new RegExp(' sfhover\\\\b'), ''); });
                    });
                });
            });
            // ]]>
        </script>
    </body>
</html>";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Christian Soronellas";
    }

    // line 26
    public function block_content($context, array $blocks = array())
    {
        // line 27
        echo "                ";
    }

    public function getTemplateName()
    {
        return "ChristianSoronellasBlogBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
