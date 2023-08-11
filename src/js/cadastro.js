function formatarTelefone(telefone) {
    //Cada if e else if fará a comparação para saber se o telefone inseri irá se tratar de celular ou telefone fixo
    telefone = telefone.replace(/\D/g, '');
    if (telefone.length === 11) {
      telefone = telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    }
    else if (telefone.length === 10) {
      telefone = telefone.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
    }
    else if (telefone.length === 9) {
      telefone = telefone.replace(/^(\d{5})(\d{4})$/, '$1-$2');
    }
    else if (telefone.length === 8) {
      telefone = telefone.replace(/^(\d{4})(\d{4})$/, '$1-$2');
    }
  
    return telefone;
  }
  //obtem os valores de cada telefone
  const inputTelefone = document.getElementById('tel');
  
  // Adiciona um ouvinte de evento de input para o campo de entrada
  inputTelefone.addEventListener('input', function(e) {
    const telefoneFormatado = formatarTelefone(e.target.value);
    e.target.value = telefoneFormatado;
  });

  
  function formatarCPF(cpf) {
    // Remove caracteres especiais como ponto e traço
    cpf = cpf.replace(/[^\d]/g, "");

    // Formata o CPF adicionando os pontos e traço
    cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");

    return cpf;
}

function formatarInput() {
    var input = document.getElementById("cpf");
    input.value = formatarCPF(input.value);
}