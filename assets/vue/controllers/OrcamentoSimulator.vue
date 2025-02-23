<template>
  <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-dark">
    <div class="form-container p-4 shadow-lg">
      <h2 class="text-center mb-4 text-white">Simular Orçamento</h2>

      <form @submit.prevent="submitForm" class="row g-3">
        <!-- Nome -->
        <div class="col-12">
          <label for="nome" class="form-label text-white">Nome</label>
          <input type="text" id="nome" v-model="nome" class="form-control" placeholder="Seu nome" required />
        </div>

        <!-- Contato -->
        <div class="col-12">
          <label for="contato" class="form-label text-white">Contato</label>
          <input type="text" id="contato" v-model="contato" class="form-control" placeholder="Seu contato" required />
        </div>

        <!-- Serviço -->
        <div class="col-12">
          <label for="servico" class="form-label text-white">Serviço</label>
          <select v-model="servico" id="servico" class="form-select" @change="updateTotal" required>
            <option disabled value="">Selecione um serviço</option>
            <option v-for="servico in servicos" :key="servico.id" :value="servico">
              {{ servico.tipo }} - R$ {{ servico.preco }}
            </option>
          </select>
        </div>

        <!-- Quantidade -->
        <div class="col-12">
          <label for="qtd" class="form-label text-white">Quantidade</label>
          <input type="range" id="qtd" v-model.number="quantidade" class="form-range" min="1" max="50" @input="updateTotal" />
          <div class="text-white">Metragem: <strong>{{ quantidade }}</strong></div>
        </div>

        <!-- Valor Total -->
        <div class="col-12 text-center">
          <strong class="text-white">Valor Total:</strong>
          <span class="text-white fw-bold">R$ {{ valorTotal.toFixed(2) }}</span>
        </div>

        <!-- Botão -->
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary w-100">Registrar orçamento</button>
        </div>
      </form>
          <!-- Carrossel de imagens do serviço -->
          <div v-if="fotos.length > 0" class="carousel-container mt-4">
            <h3 class="text-center text-white">Serviços conluídos</h3>
            <div id="carouselServico" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div v-for="(imagem, index) in fotos" :key="index" class="carousel-item" :class="{ 'active': index === 0 }">
                  <img :src="`/uploads/${imagem}`" class="d-block w-100 img-fluid" alt="Imagem do serviço">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselServico" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselServico" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
              </button>
            </div>
          </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";

const nome = ref("");
const contato = ref("");
const servicos = ref([]);
const servico = ref(null);
const quantidade = ref(1);
const valorTotal = ref(0);
const fotos = ref([]);

onMounted(() => {
  fetch("/servico/api")
    .then((response) => response.json())
    .then((data) => (servicos.value = data))
    .catch((error) => console.error("Erro ao buscar serviços:", error));
});

// Atualiza fotos quando um serviço for selecionado
watch(servico, async (newServico) => {
  if (newServico && newServico.foto) {
    fotos.value = newServico.foto;

    // Aguarda Vue atualizar o DOM
    await nextTick();

    // Reinicializa o Bootstrap Carousel para garantir a exibição correta das imagens
    const carouselElement = document.getElementById("carouselServico");
    if (carouselElement) {
      new Carousel(carouselElement);
    }
  } else {
    fotos.value = [];
  }
});


const updateTotal = () => {
  if (servico.value && servico.value.preco) {
    valorTotal.value = servico.value.preco * quantidade.value;
  }
};

const submitForm = () => {
  
  if (!nome.value.trim() || !contato.value.trim() || !servico.value) {
    alert('Por favor, preencha todos os campos obrigatórios');
    return;
  }
  
  const payload = {
    nome: nome.value.trim().substring(0, 100), // Limita tamanho
    contato: contato.value.trim().replace(/[^\d\s()-]/g, ''), // Remove caracteres especiais
    servico: Number(servico.value.id), // Converte para número
    qtd: Math.min(Math.max(quantidade.value, 1), 50), // Garante valor entre 1 e 50

  };

  fetch("/orcamento/api", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload),
  })
    .then((response) => response.json())
    .then((data) => alert(`Orçamento registrado! ID: ${data.id}`))
    .catch(() => alert("Erro ao registrar orçamento"));
};
</script>

<style scoped>
/* Define a imagem de fundo */
.container-fluid {
  background: url('/public/uploads/acrilicia-inter.jpg') no-repeat center center fixed;
  background-size: cover;
}

.carousel-container {
  max-width: 500px;
  margin: 0 auto;
}

.carousel-inner img {
  border-radius: 10px;
  max-height: 300px;
  object-fit: cover;
}

/* Ajustes para telas menores que 525px */
@media (max-width: 525px) {
  .form-container {
    max-width: 90%;
    padding: 8px;
  }

  .carousel-container {
    max-width: 100%;
  }

  .carousel-inner img {
    max-height: 200px;
  }

  .btn-primary {
    font-size: 14px;
    padding: 8px;
  }
}
/* Estiliza o container do formulário */
.form-container {
  max-width: 500px;
  background: rgba(0, 0, 0, 0.7); /* Fundo escuro semi-transparente */
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
}

/* Estiliza os inputs */
/* Estiliza os inputs */
.form-control, .form-select {
  background: rgba(255, 255, 255, 0.1);
  border: none;
  color: white;
}

.form-control::placeholder, .form-select {
  color: rgba(255, 255, 255, 0.7);
}

/* Garante que o select fique com fundo escuro e estilizado */
.form-select {
  appearance: none;
  background: rgba(255, 255, 255, 0.1);
  padding: 8px;
  border-radius: 5px;
}

/* Estiliza as opções do select */
.form-select option {
  background: rgba(0, 0, 0, 0.9);
  color: white;
}

/* Melhora a aparência ao focar no select */
.form-control:focus, .form-select:focus {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  box-shadow: none;
  outline: none;
}

/* Estiliza o botão */
.btn-primary {
  background: rgba(79, 117, 133, 0.8);
  border: none;
  transition: all 0.3s;
}

.btn-primary:hover {
  background: rgba(79, 117, 133, 1);
}

/* Estiliza o input range */
.form-range {
  width: 100%;
  accent-color: rgba(79, 117, 133, 1);
}
</style>
