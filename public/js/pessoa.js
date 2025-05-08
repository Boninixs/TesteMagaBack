function carregarPessoas() {
    fetch('/magazord/src/controller/PessoaController.php?acao=listar')
        .then(res => res.json())
        .then(dados => {
            const tbody = document.querySelector('#tabelaPessoas tbody');
            tbody.innerHTML = '';
            dados.forEach(p => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${p.idpessoa}</td>
                    <td>${p.nomepessoa}</td>
                    <td>${p.cpfpessoa}</td>
                    <td>
                        <button onclick="alterar(${p.idpessoa})">Alterar</button>
                        <button onclick="excluir(${p.idpessoa})">Excluir</button>
                        <button onclick="abrirConsultaContatos(${p.idpessoa})">Contatos</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        });
}

function abrirFormulario() {
    window.location.href = '/magazord/public/form/cadastroPessoa.html';
}

function abrirConsultaContatos(id) {
    window.location.href = `/magazord/public/contato.html?idpessoa=${id}`;
}

function alterar(id) {
    window.location.href = `/magazord/public/form/cadastroPessoa.html?idpessoa=${id}`;
}

function excluir(id) {
    if (confirm("Deseja excluir esta pessoa?")) {
        const formData = new FormData();
        formData.append('idpessoa', id);
        fetch('/magazord/src/controller/PessoaController.php?acao=excluir', { method: 'POST', body: formData })
            .then(() => carregarPessoas());
    }
}

carregarPessoas();
