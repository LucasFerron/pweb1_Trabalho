# GymFlow - Sistema de Gerenciamento de Treinos para Academias

Este repositório contém o projeto **GymFlow**, desenvolvido como parte do curso **Técnico em Desenvolvimento de Sistemas**. O objetivo é criar um sistema completo para gerenciamento de treinos em academias, aplicando conceitos de **CRUD**, **autenticação**, **programação orientada a objetos** e **gestão de banco de dados MySQL**.

---

## 📑 Sumário

1. [Funcionalidades](#-funcionalidades)  
2. [Tecnologias Utilizadas](#-Tecnologias-Utilizadas)  
3. [Pré-requisitos](#-pré-requisitos)  
4. [Instalação](#-instalação-passo-a-passo)  
5. [Fluxo de Contribuição](#-fluxo-de-contribuição)  
6. [Abrir Pull Request](#-abrir-pull-request)  

---

## ✨ Funcionalidades

###  Gerenciamento de Usuários
✅ Criar, editar, excluir e listar alunos e treinadores  

###  Gerenciamento de Exercícios  
✅ Cadastrar exercícios com:  
   - Nome  
   - Equipamento necessário  
   - Descrição detalhada  
   - Categoria (ex: Peito, Pernas)  
   - Nível (Iniciante/Intermediário/Avançado)  
✅ Editar e excluir exercícios existentes  

###  Gerenciamento de Treinos  
✅ Criar treinos personalizados (ex: Treino A, Treino B)  
✅ Associar múltiplos exercícios aos treinos  
✅ Atribuir treinos específicos para cada aluno  

---

## 👨‍💻 Tecnologias Utilizadas

| Área         | Tecnologias |
|--------------|-------------|
| **Frontend** | HTML5, CSS3, Bootstrap 5 |
| **Backend**  | PHP 8+, PDO, OOP |
| **Database** | MySQL |
| **DevOps**   | Laragon, Git/GitHub |

---

## ⚙️ Pré-requisitos

Antes de começar, certifique-se de ter instalado:
- [Git](https://git-scm.com/)  
- [Laragon](https://laragon.org/download/)  
- PHP 8+  

---

## 🚀 Instalação Passo a Passo

1. Clone o repositório:
    ```bash
    git clone https://github.com/LucasFerron/pweb1_Trabalho.git
    cd pweb1_Trabalho
    ```

2. Configure o ambiente:
    ```bash
    mv pweb1_Trabalho/ C:/laragon/www/
    ```

3. Inicie os serviços:
    - Abra o Laragon
    - Inicie Apache e MySQL
    - Acesse phpMyAdmin (http://localhost/phpmyadmin)
    - Importe `database/schema.sql`

4. Acesse o sistema:
    ```
    http://localhost/pweb1_Trabalho
    ```

---

## 🔄 Fluxo de Contribuição

1. **Partir da branch `dev`:**
    ```bash
    git checkout dev
    git pull origin dev
    ```

2. **Criar uma branch de feature:**
    ```bash
    git checkout -b feature/nome-da-sua-feature
    ```

3. **Desenvolver e testar** na sua branch.

4. **Commitar alterações:**
    ```bash
    git add .
    git commit -m "[feature] Descrição curta da feature"
    ```

5. **Enviar para o remoto:**
    ```bash
    git push origin feature/nome-da-sua-feature
    ```

---

## 🚀 Abrir Pull Request

1. Acesse o repositório no GitHub  
2. Clique em **Compare & Pull Request** ao lado da sua branch  
3. Preencha **título** e **descrição** detalhando suas alterações  
4. Verifique se está como **base: dev** e **compare: feature/...**  
5. Clique em **Create Pull Request**  

---

> **Observação:**  
> Este projeto é parte do curso **Técnico em Desenvolvimento de Sistemas**. Usamos **Laragon** para servidor local e MySQL, e o código está em **PHP (PDO & OOP)**.
