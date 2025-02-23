<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* home/servicos-opcoes.html.twig */
class __TwigTemplate_cbd49fb5b3c46dcedcf522b55d8d0022 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/servicos-opcoes.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home/servicos-opcoes.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "GR Pintura";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class\"container py-4\">
        <header class=\"text-center m-5\">
            <h2 class=\"arsenal-bold section-title\">Serviços e Valores</h2>
            <p class=\"section-description\">Fique a vontade para ter uma noção de valor para o seu seu orçamento</p>
        </header>
    <section class=\"custom-section py-5 m-4\" data-controller=\"range\" style=\"background-image: url('06-gr-text-proj.jpg');\">
    <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-6 py-4\">
        <div class=\"responsive-text\">
          <h1>Textura Projetada</h1>
          <p>Aplicação em áreas externas com longa durabilidade</p>
          <p>R\$ 27,00 por m²</p>
          <input type=\"range\" class=\"range-input\" min=\"0\" max=\"50\" step=\"5\" value=\"0\"
                  data-price=\"27\" data-action=\"input->range#update\"
                  data-range-target=\"range\">
          <span class=\"range-value\" data-range-target=\"valueLabel\">0 m²</span>
          <div class=\"total-price\">Prévia de Valor: R\$ <span class=\"price-display\" data-range-target=\"priceDisplay\">0.00</span></div>
          <p class=\"legend-description\">Lembrando que a metragem real pode variar durante a visita técnica.</p>
        </div>
        </div>
      <div class=\"col-6 py-4\">
    </div>
      </div>
    </div>
    </div>
    </section>

    <section class=\"custom-section py-5 m-4\" data-controller=\"range\" style=\"background-image: url('comercial-9.png');\">
    <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-6 py-4\">
        <div class=\"responsive-text\">
          <h1>Verniz</h1>
          <p>Excelente para renovar objetos com acabamento em madeira</p>
            <p>R\$ 25,00 por m²</p>
          <input type=\"range\" class=\"range-input\" min=\"0\" max=\"50\" step=\"5\" value=\"0\"
                  data-price=\"25\" data-action=\"input->range#update\"
                  data-range-target=\"range\">
          <span class=\"range-value\" data-range-target=\"valueLabel\">0 m²</span>
          <div class=\"total-price\">Valor aproximado - R\$: <span class=\"price-display\" data-range-target=\"priceDisplay\">0.00</span></div>
          <p class=\"legend-description\">Lembrando que a metragem real pode variar durante a visita técnica.</p>
        </div>
      </div>
      <div class=\"col-6 py-4\">

    </div>
    </div>
    </div>
    </section>

    <section class=\"custom-section py-5 m-4\" data-controller=\"range\" style=\"background-image: url('comercial-11.jpg');\">
    <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-6 py-2\">
        <div class=\"responsive-text\">
          <h1>Pintura à Óleo</h1>
          <p>Proteja superfícies metálicas</p>
            <p>R\$ 30,00 por m²</p>
          <input type=\"range\" class=\"range-input\" min=\"0\" max=\"50\" step=\"5\" value=\"0\"
                  data-price=\"30\" data-action=\"input->range#update\"
                  data-range-target=\"range\">
          <span class=\"range-value\" data-range-target=\"valueLabel\">0 m²</span>
          <div class=\"total-price\">Valor aproximado - R\$: <span class=\"price-display\" data-range-target=\"priceDisplay\">0.00</span></div>
          <p class=\"legend-description\">Lembrando que a metragem real pode variar durante a visita técnica.</p>
        </div>
      </div>
      <div class=\"col-6 py-4\">

    </div>
    </div>
    </div>
    </section>
<div>  
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/servicos-opcoes.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}GR Pintura{% endblock %}

{% block body %}
<div class\"container py-4\">
        <header class=\"text-center m-5\">
            <h2 class=\"arsenal-bold section-title\">Serviços e Valores</h2>
            <p class=\"section-description\">Fique a vontade para ter uma noção de valor para o seu seu orçamento</p>
        </header>
    <section class=\"custom-section py-5 m-4\" data-controller=\"range\" style=\"background-image: url('06-gr-text-proj.jpg');\">
    <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-6 py-4\">
        <div class=\"responsive-text\">
          <h1>Textura Projetada</h1>
          <p>Aplicação em áreas externas com longa durabilidade</p>
          <p>R\$ 27,00 por m²</p>
          <input type=\"range\" class=\"range-input\" min=\"0\" max=\"50\" step=\"5\" value=\"0\"
                  data-price=\"27\" data-action=\"input->range#update\"
                  data-range-target=\"range\">
          <span class=\"range-value\" data-range-target=\"valueLabel\">0 m²</span>
          <div class=\"total-price\">Prévia de Valor: R\$ <span class=\"price-display\" data-range-target=\"priceDisplay\">0.00</span></div>
          <p class=\"legend-description\">Lembrando que a metragem real pode variar durante a visita técnica.</p>
        </div>
        </div>
      <div class=\"col-6 py-4\">
    </div>
      </div>
    </div>
    </div>
    </section>

    <section class=\"custom-section py-5 m-4\" data-controller=\"range\" style=\"background-image: url('comercial-9.png');\">
    <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-6 py-4\">
        <div class=\"responsive-text\">
          <h1>Verniz</h1>
          <p>Excelente para renovar objetos com acabamento em madeira</p>
            <p>R\$ 25,00 por m²</p>
          <input type=\"range\" class=\"range-input\" min=\"0\" max=\"50\" step=\"5\" value=\"0\"
                  data-price=\"25\" data-action=\"input->range#update\"
                  data-range-target=\"range\">
          <span class=\"range-value\" data-range-target=\"valueLabel\">0 m²</span>
          <div class=\"total-price\">Valor aproximado - R\$: <span class=\"price-display\" data-range-target=\"priceDisplay\">0.00</span></div>
          <p class=\"legend-description\">Lembrando que a metragem real pode variar durante a visita técnica.</p>
        </div>
      </div>
      <div class=\"col-6 py-4\">

    </div>
    </div>
    </div>
    </section>

    <section class=\"custom-section py-5 m-4\" data-controller=\"range\" style=\"background-image: url('comercial-11.jpg');\">
    <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-6 py-2\">
        <div class=\"responsive-text\">
          <h1>Pintura à Óleo</h1>
          <p>Proteja superfícies metálicas</p>
            <p>R\$ 30,00 por m²</p>
          <input type=\"range\" class=\"range-input\" min=\"0\" max=\"50\" step=\"5\" value=\"0\"
                  data-price=\"30\" data-action=\"input->range#update\"
                  data-range-target=\"range\">
          <span class=\"range-value\" data-range-target=\"valueLabel\">0 m²</span>
          <div class=\"total-price\">Valor aproximado - R\$: <span class=\"price-display\" data-range-target=\"priceDisplay\">0.00</span></div>
          <p class=\"legend-description\">Lembrando que a metragem real pode variar durante a visita técnica.</p>
        </div>
      </div>
      <div class=\"col-6 py-4\">

    </div>
    </div>
    </div>
    </section>
<div>  
{% endblock %}", "home/servicos-opcoes.html.twig", "/var/www/html/gr-pintura/prod-gr/templates/home/servicos-opcoes.html.twig");
    }
}
