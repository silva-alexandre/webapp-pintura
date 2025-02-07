# Webapp - Para permitir simulação de valores dos serviços relacionado a pintura.

Desenvolvido com PHP 8.3 e framework Symfony com o objetivo de realizar análises e estudos relacionados às melhores práticas do mercado.

Com foco em MVC e Programação Orientada a Objetos (POO) e persistencias das informações em banco de dados Postgresql.

## Utilização

O objetivo da aplicação, é permitir cadastrar previamente serviços e suas unidades de medidas, como mt² ou por hora. E posteriormente estes serviços serão apresentados
como opções na seção de Orcamentos.

Onde o usuário final poderá informar seu nome e forma de contato, e em seguida selecionar o serviço desejado e configurar a quantidade desejada, e com base no valor do serviço e quantidade informada será calculado 
o valor total do orcamento automaticamente

Em resumo, o objetivo da aplicação é registrar orçamentos simulados pelo usuário final, para posterior contato e agendamento de visita técnica para orcamento real do projeto.

## Caso de uso:

Usuário final seleciona o serviço: Textura Projetada - R$: 27,00 e informa uma quantidade em mt² de 25. A aplicação irá calcular e exibir na tela o valor total de: R$:675,00.

Próximos desenvolvimentos: Desenvolver Painel de Gestão para usuário Admin, com objetivo em gestão financeira, considerando insumos e possíveis gastos com os projetos orçados.

