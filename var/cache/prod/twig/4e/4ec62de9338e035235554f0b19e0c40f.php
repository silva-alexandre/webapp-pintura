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

/* home/index.html.twig */
class __TwigTemplate_fe245d313c99451c696dfbd4a7ee2147 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "home/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "GR Pintura";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "<section class=\"hero-section position-relative\">
    <div id=\"heroCarousel\" class=\"carousel slide carousel-fade\" data-bs-ride=\"carousel\">
        <div class=\"carousel-inner\">
            ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 3));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 10
            yield "            <div class=\"carousel-item ";
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 10)) ? ("active") : (""));
            yield "\" style=\"background-image: url('";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(($context["i"] . ".png")), "html", null, true);
            yield "');\">
                <!-- O estilo de fundo será aplicado aqui -->
            </div>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        yield "        </div>
    </div>
    <div class=\"overlay-content\">
        <!-- Seu conteúdo anterior aqui -->
        <div class=\"container text-center\">
            <h1 class=\"text-white\">Cores que inspiram, resultados que impressionam.</h1>
            <p>Obtenha a excelência com a GR Pintura</p>
            <a href=\"#projetos-realizados\" class=\"btn btn-custom btn-sm\">Projetos realizados</a>
            <a href=\"#detalhes-projeto\" class=\"btn btn-custom btn-sm\">Serviços</a>
            <a href=\"https://wa.me/5511948780179\" class=\"btn btn-custom btn-sm\">Contato      <i class=\"bi bi-whatsapp\"></i></a>
        </div>
    </div>
</section>
<section id=\"projetos\" class=\"completed-projects-section py-5\">
    <div class=\"container\">
        <header class=\"text-center mb-5\">
            <h2 class=\"arsenal-bold section-title\">Projetos Realizados</h2>
            <p class=\"section-description\">Confira alguns dos projetos que realizamos com dedicação e qualidade.</p>
        </header>
        <div class=\"row g-3 justify-content-center\">
            <div class=\"col-6 col-md-4 col-lg-3\">
                <div class=\"project-image\" style=\"background-image: url('04-gr-text-proj.jpg');\"></div>
            </div>
            <div class=\"col-6 col-md-4 col-lg-3\">
                <div class=\"project-image\" style=\"background-image: url('06-gr-text-proj.jpg');\"></div>
            </div>
            <div class=\"col-6 col-md-4 col-lg-3\">
                <div class=\"project-image\" style=\"background-image: url('comercial-5.png');\"></div>
            </div>
            <div class=\"col-6 col-md-4 col-lg-3\">
                <div class=\"project-image\" style=\"background-image: url('08-gr-text-proj.jpg');\"></div>
            </div>
            <!-- Adicione mais fotos conforme necessário -->
        </div>
    </div>
</section>
<div class=\"container mt-2\">
        <header class=\"text-center mb-5\">
            <h2 class=\"arsenal-bold section-title\">Sobre Nós</h2>
            <p class=\"section-description\">Conheça um pouco mais sobre a gente, e descubra um excelente parceiro para seus projetos.</p>
        </header>
<section id=\"sobre-nos\" class=\"section-background-opacity\">
    <div class=\"container px-6 py-8 content-above-opacity\">
        <header class=\"row py-5\">
            <div class=\"col-lg-4 d-flex flex-column align-items-center gap-2\">
                <img src=\"";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("gr-pintura-logo.png"), "html", null, true);
        yield "\" alt=\"Logo GR Pinturas\" class=\"mb-4\" style=\"max-width: 200px;\">
                <p class=\"text-black text-center\">A GR Pinturas, fundada por Adriano Gubitose, é referência em pintura e revestimentos de alta qualidade na região de Jandira-SP. Nossa equipe dedicada de profissionais experientes garante resultados que superam as expectativas dos clientes.</p>
            </div>
                <div class=\"col-lg-4 mt-4 d-flex flex-column align-items-start gap-2 text-center text-lg-start\">
                    <h3 class=\"arsenal-bold text-body-emphasis\"><i class=\"bi bi-paint-bucket\"></i> Nossas Especialidades</h3>
                    <ul class=\"arsenal-regular list-specialties\">
                        <li><i class=\"bi bi-brush list-item-icon\"></i> Aplicação de texturas para áreas externas</li>
                        <li><i class=\"bi bi-droplet list-item-icon\"></i> Verniz para superfícies de madeira</li>
                        <li><i class=\"bi bi-paint-bucket list-item-icon\"></i> Pintura à óleo para superfícies metálicas</li>
                        <li><i class=\"bi bi-shield-lock list-item-icon\"></i> Impermeabilização de áreas</li>
                    </ul>
                </div>
                <div class=\"col-lg-4 mt-2 d-flex flex-column align-items-center gap-2\">
                    <h3 class=\"arsenal-bold text-body-emphasis\">Por que escolher a GR Pinturas?</h3>
                    <p class=\"arsenal-bold text-center text-black\">Transforme seu espaço com a nossa experiência comprovada e um compromisso inabalável com qualidade e pontualidade. Realizamos cada projeto como se fosse único, para dar vida aos seus sonhos.</p>
                    <a href=\"#projetos-realizados\" class=\"btn btn-custom\">Conheça nossas opções de serviços</a>
                </div>
        </header>
    </div>
</section>
</div>
<section id=\"projetos-realizados\" class=\"projects-section py-5\">
    <div class=\"container\">
        <header class=\"text-center mb-5\">
            <h2 class=\"arsenal-bold section-title\">Nossas Opções de Serviços</h2>
            <p class=\"section-description\">Explore nossas especialidades e encontre a solução perfeita para suas necessidades de pintura e revestimento.</p>
        </header>
        <div class=\"row justify-content-center\">
            <div class=\"col-6 col-md-4 mb-4\">
                <div class=\"card\">
                    <div class=\"card-cover\" style=\"background-image: url('06-gr-text-proj.jpg');\"></div>
                    <div class=\"card-body text-center\">
                        <h5 class=\"card-title\">Textura Projetada</h5>
                        <p class=\"card-text\">Aplicação para áreas externas</p>
                        <a href=\"";
        // line 93
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_servicos_opcoes");
        yield "\" class=\"stretched-link text-decoration-none text-primary fw-bold\">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class=\"col-6 col-md-4 mb-4\">
                <div class=\"card\">
                    <div class=\"card-cover\" style=\"background-image: url('comercial-11.jpg');\"></div>
                    <div class=\"card-body text-center\">
                        <h5 class=\"card-title\">Pintura à Óleo</h5>
                        <p class=\"card-text\">Aplicação em superfíces metálicas</p>
                        <a href=\"";
        // line 103
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_servicos_opcoes");
        yield "\" class=\"stretched-link text-decoration-none text-primary fw-bold\">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class=\"col-6 col-md-4 mb-4\">
                <div class=\"card\">
                    <div class=\"card-cover\" style=\"background-image: url('comercial-9.png');\"></div>
                    <div class=\"card-body text-center\">
                        <h5 class=\"card-title\">Verniz</h5>
                        <p class=\"card-text\">Ideal para objetos com acabamento em madeira.</p>
                        <a href=\"";
        // line 113
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_servicos_opcoes");
        yield "\" class=\"stretched-link text-decoration-none text-primary fw-bold\">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class=\"col-6 col-md-4 mb-4\">
                <div class=\"card\">
                    <div class=\"card-cover\" style=\"background-image: url('comercial-10.jpg');\"></div>
                    <div class=\"card-body text-center\">
                        <h5 class=\"card-title\">Impermeabilizantes</h5>
                        <p class=\"card-text\">Proteja àreas expostas à chuvas</p>
                        <a href=\"";
        // line 123
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_servicos_opcoes");
        yield "\" class=\"stretched-link text-decoration-none text-primary fw-bold\">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class=\"col-6 col-md-4 mb-4\">
                <div class=\"card\">
                    <div class=\"card-cover\" style=\"background-image: url('comercial-5.png');\"></div>
                    <div class=\"card-body text-center\">
                        <h5 class=\"card-title\">Pintura Decorativa e Personalizada </h5>
                        <p class=\"card-text\">Grafiato</p>
                        <a href=\"";
        // line 133
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_servicos_opcoes");
        yield "\" class=\"stretched-link text-decoration-none text-primary fw-bold\">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class=\"col-6 col-md-4 mb-4\">
                <div class=\"card\">
                    <div class=\"card-cover\" style=\"background-image: url('comercial-6.png');\"></div>
                    <div class=\"card-body text-center\">
                        <h5 class=\"card-title\">Pintura em geral</h5>
                        <p class=\"card-text\">Acabamento de alta qualidade</p>
                        <a href=\"";
        // line 143
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_servicos_opcoes");
        yield "\" class=\"stretched-link text-decoration-none text-primary fw-bold\">Saiba mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/index.html.twig";
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
        return array (  262 => 143,  249 => 133,  236 => 123,  223 => 113,  210 => 103,  197 => 93,  160 => 59,  113 => 14,  92 => 10,  75 => 9,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "home/index.html.twig", "/var/www/html/gr-pintura/prod-gr/templates/home/index.html.twig");
    }
}
