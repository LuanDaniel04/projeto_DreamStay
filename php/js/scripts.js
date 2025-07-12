document.addEventListener("DOMContentLoaded", () => {
  // Toggle campos adicionais para vendedor
  // const btnToggleVendedor = document.getElementById("btnToggleVendedor");
  // const camposVendedor = document.getElementById("camposVendedor");

  // if (btnToggleVendedor && camposVendedor) {
  //   btnToggleVendedor.addEventListener("click", () => {
  //     if (camposVendedor.style.display === "none" || camposVendedor.style.display === "") {
  //       camposVendedor.style.display = "block";
  //       btnToggleVendedor.textContent = "Não sou vendedor";
  //     } else {
  //       camposVendedor.style.display = "none";
  //       btnToggleVendedor.textContent = "Sou vendedor";
  //       limparCamposVendedor();
  //     }
  //   });
  // }

  // Limpa os campos extras do vendedor
  // function limparCamposVendedor() {
  //   const telefone = document.getElementById("telefoneInput");
  //   const cnpj = document.getElementById("cnpjInput");
  //   const nomeEmpresa = document.getElementById("nomeEmpresaInput");

  //   if (telefone) telefone.value = "";
  //   if (cnpj) cnpj.value = "";
  //   if (nomeEmpresa) nomeEmpresa.value = "";
  // }

  // Validação de senha (confirmação)
  const formCadastro = document.getElementById("formCadastro");
  if (formCadastro) {
    formCadastro.addEventListener("submit", (e) => {
      const senha = document.getElementById("senhaInput").value;
      const confirmaSenha = document.getElementById("confirmaSenhaInput").value;

      if (senha !== confirmaSenha) {
        e.preventDefault();
        alert("As senhas não coincidem. Por favor, verifique.");
      }
    });
  }
});
