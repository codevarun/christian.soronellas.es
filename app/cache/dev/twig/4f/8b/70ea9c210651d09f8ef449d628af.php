<?php

/* ChristianSoronellasBlogBundle:Default:post.html.twig */
class __TwigTemplate_4f8b70ea9c210651d09f8ef449d628af extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<div id=\"post-";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false), "html");
        echo "\" class=\"post-";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false), "html");
        echo " post\">
    <div class=\"post-header\">
        <h2><a href=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("post", array("id" => $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false))), "html");
        echo "\" rel=\"bookmark\" title=\"Permanent Link to ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'post'), "title", array(), "any", false));
        echo " ?>\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'post'), "title", array(), "any", false));
        echo "</a></h2>
        <p>by Christian Soronellas on ";
        // line 4
        echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($this->getContext($context, 'post'), "created_at", array(), "any", false), "d/m/Y"), "html");
        echo "</p>
    </div>
    ";
        // line 6
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'post'), "body", array(), "any", false), "js"), "html");
        echo "
    <div class=\"post-meta\">
        <ul>
            <li><a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("post", array("id" => $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false))), "html");
        echo "#comments\">Leave your comment</a></li>
            <li>Share on <a href=\"http://twitter.com/home?status=Currently reading: ";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'post'), "title", array(), "any", false));
        echo " ";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("post", array("id" => $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false))), "html");
        echo "\">Twitter</a>, <a href=\"http://www.facebook.com/share.php?u=";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("post", array("id" => $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false))), "html");
        echo "&amp;t=";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'post'), "title", array(), "any", false));
        echo "\">Facebook</a>, <a href=\"http://del.icio.us/post?v=4;url=";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("post", array("id" => $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false))), "html");
        echo "\">Delicious</a>, <a href=\"http://digg.com/submit?url=";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("post", array("id" => $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false))), "html");
        echo "\">Digg</a>, <a href=\"http://www.reddit.com/submit?url=";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("post", array("id" => $this->getAttribute($this->getContext($context, 'post'), "id", array(), "any", false))), "html");
        echo "&amp;title=";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'post'), "title", array(), "any", false));
        echo "\">Reddit</a></li>
        </ul>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "ChristianSoronellasBlogBundle:Default:post.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
