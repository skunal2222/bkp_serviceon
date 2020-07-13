<?php

/* display/results/value_display.twig */
class __TwigTemplate_2725e99e75e651bdc9fe93d9f18001e634247fd41a1c5f7deaf387d8ac9497e3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<td class=\"left ";
        echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
        echo ((($context["condition_field"] ?? null)) ? (" condition") : (""));
        echo "\">
    ";
        // line 2
        echo ($context["value"] ?? null);
        echo "
</td>
";
    }

    public function getTemplateName()
    {
        return "display/results/value_display.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display/results/value_display.twig", "/var/www/html/db/templates/display/results/value_display.twig");
    }
}
