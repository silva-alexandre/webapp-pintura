<template>
  <div class="home">
    <!-- HERO -->
    <section class="hero">
      <div class="container">
        <div class="hero-content">
          <h1>Cores que inspiram resultados que impresionam</h1>
          <p>Conheça a GR Pintura e garanta a sua satisfação.</p>
          <a href="#servicos" class="btn btn-primary-custom btn-lg mt-4">Conheça nossos serviços</a>
        </div>
      </div>
    </section>

    <!-- SOBRE NÓS -->
    <section class="section" id="sobre">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-md-2 text-center">
            <img
              src="../../../public/gr-pintura-logo.png"
              class="img-fluid rounded sobre-nos-img mb-4"
              alt="Equipe GR Pintura"
            />
            <div class="tab-buttons mb-4 text-center">
              <button
                v-for="(tab, index) in sobreTabs"
                :key="index"
                :class="['tab-btn', { active: activeTab === index }]"
                @click="activeTab = index"
              >
                {{ tab.titulo }}
              </button>
            </div>
          </div>
          <div class="col-md-6 order-md-1">
            <div class="sobre-tabs">
              <transition name="fade" mode="out-in">
                <div :key="activeTab" class="tab-content">
                  <h2>{{ sobreTabs[activeTab].titulo }}</h2>
                  <p>{{ sobreTabs[activeTab].descricao }}</p>
                </div>
              </transition>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVIÇOS -->
    <section class="section" id="servicos">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="fw-bold">Nossos Serviços</h2>
          <p>Conheça nossas soluções em pintura</p>
        </div>

        <!-- Navbar minimalista -->
        <nav class="servicos-nav mb-4">
          <div class="nav-wrapper">
            <button
              v-for="servico in servicos"
              :key="servico.id"
              :class="['nav-item', { active: servico.id === selectedServico.id }]"
              @click="selectServico(servico)"
            >
              {{ servico.titulo }}
            </button>
          </div>
        </nav>

        <!-- Painel de detalhes unificado -->
        <div class="servico-panel">
          <div class="row">
            <div class="col-md-6">
              <div class="carousel-wrapper position-relative">
                <img
                  :src="selectedServico.images[currentImageIndex]"
                  class="img-fluid rounded"
                  :alt="`Imagem ${currentImageIndex + 1} de ${selectedServico.titulo}`"
                />
                <button class="carousel-control prev" @click="prevImage">‹</button>
                <button class="carousel-control next" @click="nextImage">›</button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="servico-info">
                <h3 class="detail-title">{{ selectedServico.titulo }}</h3>
                <p class="detail-text">{{ selectedServico.longDescription }}</p>
                
                <div class="calculator-wrapper mt-4">
                  <p class="price-label">Valor por m²: {{ selectedServico.precoM2 | moeda }}</p>
                  <div class="range-wrapper">
                    <input
                      type="range"
                      class="form-range"
                      min="0"
                      max="50"
                      v-model="selectedServico.metros"
                    />
                    <div class="d-flex justify-content-between mt-2">
                      <span>Área: {{ selectedServico.metros }} m²</span>
                      <strong>{{ calcularPreco(selectedServico) }}</strong>
                    </div>
                  </div>
                  <button class="btn-orcamento mt-3" @click="enviarOrcamento">
                    Solicitar Orçamento
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA FINAL -->
    <section class="section text-center">
      <div class="container">
        <h2>Pronto para transformar seu imóvel?</h2>
        <p>Solicite um orçamento sem compromisso agora mesmo.</p>
        <a href="#orcamento" class="btn btn-primary-custom btn-lg">Fale conosco</a>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'HomePage',
  data() {
    return {
      servicos: [
        {
          id: 1,
          titulo: 'Textura Projetada',
          descricao: 'Acabamento moderno e resistente para áreas externas.',
          longDescription:
            'Ótima para renovação de áreas externas, suporta variações climáticas e mantém a cor por até 5 anos.',
          img: require('../../../public/5.jpg'),
          images: [
            require('../../../public/comercial-6.png'),
            require('../../../public/4.jpg'),
            require('../../../public/2.jpg'),
          ],
          precoM2: 25,
          metros: 10,
        },
        {
          id: 2,
          titulo: 'Textura Acrílica',
          descricao: 'Técnicas refinadas com tintas de alta durabilidade.',
          longDescription:
            'Ideal para ambientes internos e externos, acabamento liso ou rústico conforme a necessidade.',
          img: require('../../../public/5.jpg'),
          images: [
          require('../../../public/4.jpg'),
          require('../../../public/2.jpg'),
          ],
          precoM2: 18,
          metros: 10,
        },
        {
          id: 3,
          titulo: 'Vernizamento',
          descricao: 'Acabamento refinado com proteção duradoura.',
          longDescription:
            'Protege e realça a madeira, resistente a riscos e fácil manutenção.',
          img: require('../../../public/5.jpg'),
          images: [
          require('../../../public/4.jpg'),
          require('../../../public/2.jpg'),
          ],
          precoM2: 22,
          metros: 10,
        },
      ],
      selectedServico: null,
      currentImageIndex: 0,
      sobreTabs: [
        {
          titulo: 'Nossa História',
          descricao:
            'Com anos de experiência no mercado de pintura residencial de alto padrão, a GR Pintura se destaca por sua excelência, compromisso e atenção aos detalhes.',
        },
        {
          titulo: 'Nossa Missão',
          descricao:
            'Trabalhamos com materiais de qualidade e equipe especializada para garantir que cada projeto reflita o estilo e a sofisticação que nossos clientes esperam.',
        },
        {
          titulo: 'Nossos Valores',
          descricao:
            'Excelência, compromisso e atenção aos detalhes são os pilares que sustentam nosso trabalho.',
        },
      ],
      activeTab: 0,
    }
  },
  created() {
    this.selectedServico = this.servicos[0]
  },
  methods: {
    selectServico(servico) {
      this.selectedServico = servico
      this.currentImageIndex = 0
    },
    enviarOrcamento() {
      alert('Orçamento solicitado! Entraremos em contato em breve.')
    },
    calcularPreco(servico) {
      return (servico.metros * servico.precoM2).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL',
      })
    },
    prevImage() {
      this.currentImageIndex =
        (this.currentImageIndex + this.selectedServico.images.length - 1) %
        this.selectedServico.images.length
    },
    nextImage() {
      this.currentImageIndex =
        (this.currentImageIndex + 1) % this.selectedServico.images.length
    },
  },
  filters: {
    moeda(value) {
      return value.toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL',
      })
    },
  },
}
</script>

<style scoped>
:root {
  --verde-floresta: #284b3b;
  --crema-suave: #f2e8cf;
  --bronze-antigo: #b08d57;
  --verde-salvia: #a8b5a8;
  --cinza-quente: #8e8577;
}

.home {
  background-color: var(--verde-floresta);
  color: var(--crema-suave);
  font-family: 'Segoe UI', sans-serif;
}

/* HERO */
.hero {
  background: url('../../../public/06-gr-text-proj.jpg') center / cover no-repeat;
  min-height: 100vh;
  display: flex;
  align-items: center;
}
.hero .container {
  width: 100%;
  padding: 0 clamp(1rem, 5vw, 3rem);
}
.hero-content {
  max-width: 800px;
  background-color: rgba(1, 1, 1, 0.4);
  padding: clamp(2rem, 4vw, 3rem);
  border-radius: 1rem;
  margin-left: clamp(1rem, 5%, 5%);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(5px);
}
.hero h1 {
  font-size: clamp(2rem, 5vw, 3rem);
  margin-bottom: 1rem;
}
.hero p {
  font-size: clamp(1rem, 2vw, 1.25rem);
  margin-bottom: 1.5rem;
}
.btn-primary-custom {
  background-color: var(--verde-salvia);
  color: var(--verde-floresta);
  border: none;
  padding: 0.8rem 2rem;
}
.btn-primary-custom:hover {
  background-color: var(--bronze-antigo);
  color: var(--crema-suave);
}

/* SECTIONS */
.section {
  padding: 60px 0;
  border-top: 1px solid var(--cinza-quente);
}
.section h2 {
  color: var(--bronze-antigo);
}

/* SOBRE NÓS */
.sobre-nos-img {
  width: 100%;
  height: 350px;
  object-fit: contain;
  max-width: 450px;
}
@media (max-width: 768px) {
  .sobre-nos-img {
    height: 300px;
  }
}
.tab-buttons {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  justify-content: center;
}
.tab-btn {
  background-color: rgba(255, 255, 255, 0.1);
  color: var(--crema-suave);
  border: 1px solid var(--cinza-quente);
  padding: 0.4rem 0.8rem;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
}
.tab-btn:hover {
  background-color: var(--verde-salvia);
  color: var(--verde-floresta);
}
.tab-btn.active {
  background-color: var(--bronze-antigo);
  color: var(--crema-suave);
  border-color: var(--bronze-antigo);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

#servicos {
  position: relative;
  background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), 
              url('../../../public/text-background.png');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  background-repeat: no-repeat;
}

/* CARD SERVIÇO */
.card-servico {
  background-color: rgba(0, 0, 0, 1);
  border: none;
  border-radius: 1rem;
  overflow: hidden;
  color: var(--crema-suave);
}
.card-servico img {
  object-fit: cover;
  height: 350px;
}
.card-servico .card-body {
  text-align: center;
}
.range-wrapper {
  background-color: rgba(255, 255, 255, 0.1);
  padding: 1rem;
  border-radius: 0.5rem;
  margin-top: 1rem;
}
.form-range {
  width: 100%;
}
.form-range::-webkit-slider-thumb {
  background: var(--bronze-antigo);
}
.form-range::-moz-range-thumb {
  background: var(--bronze-antigo);
}

/* SERVIÇOS NAVBAR */
.servicos-nav {
  display: flex;
  justify-content: center;
  border-radius: 0.5rem;
  padding: 0.5rem;

}

.nav-wrapper {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  justify-content: center;
}

.nav-item {
  background: transparent;
  color: var(--crema-suave);
  border: 1px solid var(--cinza-quente);
  padding: 0.6rem 1.2rem;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.nav-item:hover {
  background-color: var(--verde-salvia);
  color: var(--verde-floresta);
}

.nav-item.active {
  background-color: var(--bronze-antigo);
  color: var(--crema-suave);
  border-color: var(--bronze-antigo);
}

/* PAINEL DE SERVIÇO */
.servico-panel {
  background: rgba(10, 10, 10, 0.4);
  border-radius: 1rem;
  padding: 2rem;
  margin-top: 2rem;
}

.servico-info {
  padding: 0 1rem;
}

.calculator-wrapper {
  background: rgba(255, 255, 255, 0.05);
  padding: 1.5rem;
  border-radius: 0.5rem;
}

.price-label {
  color: var(--bronze-antigo);
  font-size: 1.1rem;
  margin-bottom: 1rem;
}

.btn-orcamento {
  width: 100%;
  background-color: var(--bronze-antigo);
  color: var(--crema-suave);
  border: none;
  padding: 0.8rem;
  border-radius: 0.5rem;
  transition: all 0.3s ease;
}

.btn-orcamento:hover {
  background-color: var(--verde-salvia);
  color: var(--verde-floresta);
}

/* DETALHES - painel da direita */
.details-panel {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 1rem;
  color: var(--crema-suave);
}
.detail-title {
  color: var(--bronze-antigo);
  margin-bottom: 0.5rem;
}
.carousel-wrapper {
  position: relative;
  overflow: hidden;
  border-radius: 0.5rem;
  margin-top: 1rem;
}
.carousel-wrapper img {
  width: 100%;
  display: block;
}
.carousel-control {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.4);
  border: none;
  font-size: 2rem;
  line-height: 1;
  width: 2.5rem;
  height: 2.5rem;
  color: var(--crema-suave);
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  padding-bottom: 0.1rem;
}
.carousel-control.prev {
  left: 0.5rem;
}
.carousel-control.next {
  right: 0.5rem;
}

/* Botão ativo da lista de serviços */
.btn-outline-light.active {
  background-color: var(--bronze-antigo);
  border-color: var(--bronze-antigo);
  color: var(--crema-suave);
}
</style>
