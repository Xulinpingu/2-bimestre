# Relatório de Projeto - MIT App Inventor

**Instituição:** Etec Vasco Antônio Venchiarutti  
**Curso:** Desenvolvimento de Sistemas  
**Turma:** 2°C¹  
**Autores:** Bruno Lourenço de Lima; Isaac Faleiros Quevedo  

---

## 📌 Índice / Navegação
- [**1-bim: Petróleo Clicker Simulator**](#1-bim-petróleo-clicker-simulator)
  - [Descrição do Aplicativo](#descrição)
  - [Design das Telas](#-print-das-telas-do-design)
  - [Programação em Blocos](#-print-das-telas-dos-blocos)
- [**2-bim: Componentes Avançados e Conectividade**](#2-bim-componentes-avançados-e-conectividade)
  - [Componentes Avançados 1: Comunicação](#componentes-avançados-1-comunicação-e-web)
  - [Componentes Avançados 2: Recursos do Sistema](#componentes-avançados-2-localização-e-recursos-do-dispositivo)

---

# 1-bim: Petróleo Clicker Simulator

## Descrição

* **Objetivo do aplicativo:** Divertir o usuário de forma simples e intuitiva, passar o tempo e, por meio de perguntas implementadas, informar sobre a guerra e atiçar a curiosidade sobre esse assunto.

* **Como o aplicativo funciona:** O jogo começa clicando no botão 'Play', no canto superior direito da tela, se tornando um botão 'Reset' após isso. Quando o jogo inicia, se baseia em clicar no botão 'Extrair Petróleo' para acumular petróleo e com esse petróleo acumulado ir para a página upgrades, clicando no botão 'Upgrades', e gastar os pontos de petróleo para pegar melhorias e assim adquirir pontos mais rápido. A cada 2 minutos também aparece um botão para responder a uma pergunta, e caso acerte, ganha 2x de pontos por 30 segundos.

* **Quais conceitos da apostila foram utilizados:** Botão, parte essencial do jogo que foi muito utilizado na apostila; múltiplas páginas, como feito em um dos aplicativos tutoriais da apostila; texto básico como label.

* **Quais recursos ou componentes foram utilizados:** Label; Button; Vertical Scroll Arrangement; Horizontal Arrangement; Image; TinyDB; Clock; CheckBox.

* **Se houve melhorias ou ideias novas em relação aos exemplos da apostila:** Com os trabalhos que fizemos na apostila, não aprendemos sobre TinyDB, Clock, tela scrollável e alguns códigos utilizados, sendo essas novas ideias em relação ao apresentado na apostila.

---

## 🖥 Print das telas do Design

### Tela Inicial
![Screen1-Design](Imagens/Screen1-Design.png)

### Upgrades
![Upgrades-Design](Imagens/Upgrades-Design.png)  
***obs:** os botões estão em branco porque seu preço e respectivos upgrades variam de acordo com o número de vezes comprado, então seu texto é colocado por meio do código.*

### Pergunta 1
![Pergunta1-Design](Imagens/Pergunta1-Design.png)

### Pergunta 2
![Pergunta2-Design](Imagens/Pergunta2-Design.png)

### Pergunta 3
![Pergunta3-Design](Imagens/Pergunta3-Design.png)

### Pergunta 4
![Pergunta4-Design](Imagens/Pergunta4-Design.png)

---

## 🧩 Print das telas dos Blocos

### Tela Inicial
![Screen1-Block1](Imagens/Screen1-Block1.png)  
![Screen1-Block2](Imagens/Screen1-Block2.png)

### Upgrades
![Upgrades-Block1](Imagens/Upgrades-Block1.png)  
![Upgrades-Block2](Imagens/Upgrades-Block2.png)  
![Upgrades-Block3](Imagens/Upgrades-Block3.png)  
![Upgrades-Block4](Imagens/Upgrades-Block4.png)

### Pergunta 1
![Pergunta1-Block1](Imagens/Pergunta1-Block1.png)  
![Pergunta1-Block2](Imagens/Pergunta1-Block2.png)

### Pergunta 2
![Pergunta2-Block1](Imagens/Pergunta2-Block1.png)  
![Pergunta2-Block2](Imagens/Pergunta2-Block2.png)

### Pergunta 3
![Pergunta3-Block1](Imagens/Pergunta3-Block1.png)  
![Pergunta3-Block2](Imagens/Pergunta3-Block2.png)

### Pergunta 4
![Pergunta4-Block1](Imagens/Pergunta4-Block1.png)  
![Pergunta4-Block2](Imagens/Pergunta4-Block2.png)

---

# 2-bim: Componentes Avançados e Conectividade

Expandindo o escopo do projeto autoral, foram incorporados componentes avançados do ecossistema do MIT App Inventor voltados à integração com a web, comunicação externa e ferramentas nativas do sistema operacional:

## Componentes Avançados 1: Comunicação e Web
  ![Componentes-Avancados-Web-Design](Imagens/img1.png)
  
- **Link da web (WebViewer / Sharing):** Componente empregado para abrir páginas externas, permitindo ao usuário acessar artigos informativos, notícias ou referências de fontes confiáveis diretamente dentro da navegação do jogo.
  ![Componentes-Avancados-Web-Design](Imagens/img2.png)
  ![Componentes-Avancados-Web-Design](Imagens/img3.png)

- **Correio eletrônico:** Sistema de envio automatizado de e-mails integrado aos blocos, utilizado para encaminhar relatórios de progresso ou pontuações diretamente do aparelho.
  ![Componentes-Avancados-Web-Design](Imagens/img4.png)
  ![Componentes-Avancados-Web-Design](Imagens/img5.png)
  ![Componentes-Avancados-Web-Design](Imagens/img6.png)

## Componentes Avançados 2: Localização e Recursos do Dispositivo
  ![Componentes-Avancados-Web-Design](Imagens/img7.png)
  
- **Mapa (Map):** Inclusão de mapas geográficos interativos na interface para visualização espacial de dados e coordenadas relacionadas ao tema do projeto.
    ![Componentes-Avancados-Web-Design](Imagens/img8.png)
    ![Componentes-Avancados-Web-Design](Imagens/img9.png)

- **Chamada telefônica (PhoneCall):** Utilização do componente nativo do sistema para acionar chamadas telefônicas diretamente a partir de cliques e eventos programados na lógica de blocos.
    ![Componentes-Avancados-Web-Design](Imagens/img10.png)
    ![Componentes-Avancados-Web-Design](Imagens/img11.png)  