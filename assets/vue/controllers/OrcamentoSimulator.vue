<template>
  <div id="orcamento-simulator" data-home-url="{{ path('app_home') }}" class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-dark">
    <div class="form-container p-4 shadow-lg">
      <h2 class="text-center mb-4 text-white">Simular Orçamento</h2>

      <form @submit.prevent="submitForm" class="row g-3">
        <!-- Nome -->
        <div class="col-12">
          <label for="nome" class="form-label text-white">Como gostaria de se apresentar</label>
          <input type="text" id="nome" v-model="nome" class="form-control" placeholder="Seu nome" required />
        </div>

        <!-- Contato -->
        <div class="col-12">
          <label for="contato" class="form-label text-white">Sua opção de contato favorita</label>
          <input type="text" id="contato" v-model="contato" class="form-control" placeholder="Informe seu Instagram, facebook ou whatsapp..." required />
        </div>

        <!-- Serviço -->
        <div class="col-12">
          <label for="servico" class="form-label text-white">Escolha um Serviço</label>
          <select v-model="servico" id="servico" class="form-select" @change="updateTotal" required>
            <option disabled value="">Selecione um serviço</option>
            <option v-for="servico in servicos" :key="servico.id" :value="servico">
              {{ servico.tipo }} - R$ {{ servico.preco }}
            </option>
          </select>
        </div>

        <!-- Quantidade -->
        <div class="col-12">
          <label for="qtd" class="form-label text-white">Informe a metragem em mt²</label>
          <input type="range" id="qtd" v-model.number="quantidade" class="form-range" min="1" max="50" @input="updateTotal" />
          <div class="text-white">Metragem desejada: <strong>{{ quantidade }}</strong></div>
        </div>

        <!-- Valor Total -->
        <div class="col-12 text-center">
          <strong class="text-white">Seu orçamento será próximo de: </strong>
          <span class="text-white">R$ {{ valorTotal.toFixed(2) }}</span>
          </br>
        </div>
          <p class="text-white fst-italic">O valor do orcamento é calculado com base no valor do Serviço 
            selecionado multiplicado através da metragem selecionada.        
          </p>
          </br>
        <!-- Botão -->
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary w-100">Registrar orçamento</button>
        </div>
        </br>
        <strong class="text-white mt-2">Reforçamos que a metragem real do projeto pode variar conforme nossa visita técnica, dessa forma garantimos um orçamento mais preciso.</strong>          
      </br>
      </form>
          <!-- Carrossel de imagens do serviço -->
          <div v-if="fotos.length > 0" class="carousel-container mt-4">
            <h3 class="text-center text-white">Serviços realizados</h3>
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
  <!-- Add this right after your form-container div -->
  <div v-if="showSuccessModal" class="modal-overlay">
    <div class="success-modal">
      <h3>Sucesso!</h3>
      <p>Seu orçamento foi enviado com sucesso.</p>
      <button @click="closeModalAndRedirect" class="btn btn-primary">OK</button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, nextTick  } from "vue";
import { useRouter } from 'vue-router';

const router = useRouter();
const showSuccessModal = ref(false);

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
      const carouselInstance = bootstrap.Carousel.getInstance(carouselElement);
      if (carouselInstance) {
        carouselInstance.dispose(); // Destrói a instância anterior
      }
      new bootstrap.Carousel(carouselElement); // Cria uma nova instância
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


  const message = encodeURIComponent(
    `*Novo Orçamento*\n\n` +
    `*Nome:* ${payload.nome}\n` +
    `*Contato:* ${payload.contato}\n` +
    `*Serviço:* ${servico.value.tipo}\n` +
    `*Metragem:* ${payload.qtd}m²\n` +
    `*Valor Total:* R$ ${valorTotal.value.toFixed(2)}`
  );
  
   // Número do WhatsApp (substitua pelo número correto)
   const phoneNumber = "5511982143688"; // Exemplo: 55 + DDD + número

  // Criar o link do WhatsApp
  const whatsappUrl = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${message}`;


  fetch("/orcamento/api", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload),
  })
    .then((response) => response.json())
    .then(() => {
      // Redirecionar para o WhatsApp em uma nova aba
      window.open(whatsappUrl, '_blank');
      showSuccessModal.value = true;
    })
    .catch(() => alert("Erro ao registrar orçamento"));
};

const closeModalAndRedirect = () => {
  showSuccessModal.value = false;
  window.location.href = '/home'; 
};
</script>

<style scoped>
/* Define a imagem de fundo */
.container-fluid {
  height: 100vh;
  background: url('/public/uploads/text-projetada.jpg') no-repeat center center fixed;
  background-size: cover; /* Cobre a tela */
  background-position: center;
  margin-bottom: 0;
}

.carousel-container {
  max-width: 500px;
  margin: 0 auto;
}

.carousel-item {/* Garante que o carrossel cubra toda a altura da seção */
max-height: 300px;
background-size: cover;
background-position: center;
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

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.success-modal {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  text-align: center;
  max-width: 400px;
  width: 90%;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.success-modal h3 {
  margin-bottom: 1rem;
  color: #28a745;
}

.success-modal p {
  margin-bottom: 1.5rem;
}

.success-modal button {
  min-width: 120px;
}
</style>
