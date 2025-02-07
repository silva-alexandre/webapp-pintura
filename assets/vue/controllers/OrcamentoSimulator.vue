<template>
  <div class="container">
    <h1 class="text-center my-4">Simular Novo Orçamento</h1>
    <div class="form-container">
      <form @submit.prevent="submitForm">
        <!-- Nome do Cliente -->
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input
            type="text"
            id="nome"
            v-model="cliente.nome"
            class="form-control"
            placeholder="Seu nome"
            required
          />
        </div>

        <!-- Contato do Cliente -->
        <div class="mb-3">
          <label for="contato" class="form-label">Contato</label>
          <input
            type="text"
            id="contato"
            v-model="cliente.contato"
            class="form-control"
            placeholder="Seu e-mail ou telefone"
            required
          />
        </div>

        <!-- Seleção de Serviço -->
        <div class="mb-3">
          <label for="servico" class="form-label">Selecione um Serviço</label>
          <select
            v-model="orcamento.id_servico"
            id="servico"
            class="form-select"
            @change="updateTotal"
            required
          >
            <option value="" disabled>Escolha um serviço</option>
            <option v-for="servico in servicos" :key="servico.id" :value="servico.id">
              {{ servico.tipo }} - R$ {{ servico.valor_unid }}
            </option>
          </select>
        </div>

        <!-- Quantidade (Metragem) como Range -->
        <div class="mb-3">
          <label for="qtd" class="form-label">Informe a metragem desejada</label>
          <input
            type="range"
            id="qtd"
            v-model.number="orcamento.qtd"
            class="form-range"
            min="1"
            max="100"
            @input="updateTotal"
            :disabled="!orcamento.id_servico"
          />
          <div class="text-muted">Metragem: {{ orcamento.qtd }}</div>
        </div>

        <!-- Exibição do Valor Total -->
        <div class="mb-3">
          <strong>Preço estimado:</strong> R$ {{ orcamento.valor_total.toFixed(2) }}
        </div>

        <!-- Botão de Envio -->
        <button type="submit" class="btn btn-primary w-100">Simular Orçamento</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      servicos: [], // Lista de serviços da API
      cliente: {
        nome: "",
        contato: "",
      },
      orcamento: {
        id_servico: null, // ID do serviço selecionado
        qtd: 10, // Quantidade inicial
        valor_total: 0, // Valor total calculado
      },
    };
  },
  methods: {
    fetchData() {
      fetch("/servico/api") // Ajuste para a URL correta da API
        .then((response) => response.json())
        .then((data) => {
          this.servicos = data;
        })
        .catch((error) => {
          console.error("Erro ao carregar serviços:", error);
        });
    },
    updateTotal() {
      const servicoSelecionado = this.servicos.find(
        (s) => s.id === this.orcamento.id_servico
      );

      if (servicoSelecionado) {
        this.orcamento.valor_total = servicoSelecionado.valor_unid * this.orcamento.qtd;
      } else {
        this.orcamento.valor_total = 0;
      }
    },
    submitForm() {
      const payload = {
        cliente: this.cliente,
        id_servico: this.orcamento.id_servico,
        qtd: this.orcamento.qtd,
        valor_total: this.orcamento.valor_total,
      };

      console.log("Enviando dados:", payload);

      fetch("/orcamento/api", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      })
        .then((response) => response.json())
        .then((data) => {
          alert(`Orçamento registrado com sucesso! ID: ${data.id}`);
        })
        .catch((error) => {
          console.error("Erro ao registrar orçamento:", error);
          alert("Ocorreu um erro ao processar sua solicitação.");
        });
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 40px auto;
}
.form-container {
  background: #f8f9fa;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.form-control, .form-select {
  border-radius: 5px;
}
.form-range {
  cursor: pointer;
}
.btn-primary {
  background-color: #007bff;
  border: none;
}
.btn-primary:hover {
  background-color: #0056b3;
}
</style>
