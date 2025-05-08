const params = new URLSearchParams(window.location.search);
const idPessoa = params.get('idpessoa');

if (idPessoa) {
    document.getElementById('idpessoaFiltro').value = idPessoa;
    carregarContatos();
}

function carregarContatos() {
    const idpessoa = document.getElementById('idpessoaFiltro').value;
    if (!idpessoa) {
        alert('Informe o Id da Pessoa');
        return;
    }

    fetch(`/magazord/src/controller/ContatoController.php?acao=listar&idpessoa=${idpessoa}`)
        .then(res => res.json())
        .then(dados => {
            const tbody = document.querySelector('#tabelaContatos tbody');
            tbody.innerHTML = '';
            dados.forEach(c => {
                console.log(c);
                const tipo = c.tipocontato == 0 ? 'Telefone' : 'Email';
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${c.idcontato}</td>
                    <td>${tipo}</td>
                    <td>${c.descricaocontato}</td>
                    <td>
                        <button onclick="alterar(${c.idcontato}, ${c.idpessoa})">Alterar</button>
                        <button onclick="excluir(${c.idcontato})">Excluir</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        });
}

function carregarPessoas() {
    window.location.href = '/magazord/public/pessoa.html';
}

function abrirFormulario() {
    window.location.href = `/magazord/public/form/cadastroContato.html?idpessoa=${idPessoa}`;
}

function alterar(id, idpessoa) {
    window.location.href = `/magazord/public/form/cadastroContato.html?idcontato=${id}&idpessoa=${idpessoa}`;
}

function excluir(id) {
    if (confirm("Deseja excluir este contato?")) {
        const formData = new FormData();
        formData.append('idcontato', id);
        fetch('/magazord/src/controller/ContatoController.php?acao=excluir', { method: 'POST', body: formData })
            .then(() => carregarContatos());
    }
}
