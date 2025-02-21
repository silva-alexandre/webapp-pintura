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
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const nome = ref("");
const contato = ref("");
const servicos = ref([]);
const servico = ref(null);
const quantidade = ref(1);
const valorTotal = ref(0);

onMounted(() => {
  fetch("/servico/api")
    .then((response) => response.json())
    .then((data) => (servicos.value = data));
});

const updateTotal = () => {
  if (servico.value && servico.value.preco) {
    valorTotal.value = servico.value.preco * quantidade.value;
  }
};

const submitForm = () => {
  const payload = {
    nome: nome.value,
    contato: contato.value,
    servico: servico.value ? servico.value.id : null,
    qtd: quantidade.value,
    valortotal: valorTotal.value,
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
