## Jarbas 
#### Sistema de Gerenciamento de Eventos Acadêmicos
---

Desenvolvido como requisito de obtenção de título de Téncnico em Informática para WEB do curso 
Técnico de Informática para WEB do Instituto Federal do Rio Grande do Sul - IFRS

**Objetivo:**
+ Desenvolver um sistema que gerencie eventos acadêmicos, disponibilizando um portal para os participantes, oficineiros/palestrantes, regulando o acesso. 
+ Este sistema contará com grade de horários, impressão de crachás, impressão de certificados e diversos relatórios estatísticos.

---

**Envolvidos:**
+ Professora: Ana Paula Lemke.
+ Alunos/Pólo: Augusto Weiand e Deividi Dchumacher Velho / Polo de Santo Antônio da Patrulha.

---

**Requisitos:**
+ PHP 5 ou superior
+ Apache 2.2 ou superior
+ PostgreSQL 8.0 ou superior

**Módulos Apache Necessários:**
+ mod_rewrite

**Módulos PHP Necessários:**
+ php5-pgsql

**Configuração Default de acesso ao SGBD**
+ Login: postgres
+ Senha: postgres
+ Database: jarbas

---

**Configurações Default**
+ Para alterar as configurações de acesso ao SGBD altere o arquivo: 'mainframe/classes/database.class.php'
+ Se o sistema for ficar em alguma subpasta que não seja a raiz do 'localhost', altere o seguinte arquivo: 'mainframe/autoload.php'
+ Não esqueça de baixar uma cópia dos plugins de terçeiros que não são incluídos no Git, para suas devidas pastas, as quais devem estar vazias dentro de 'mainframe/plugins/':
- [Font-Awesome](https://github.com/FortAwesome/Font-Awesome)
- [tokeninput](https://github.com/loopj/jquery-tokeninput)
