--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: actlogs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE actlogs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.actlogs_id_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: actlogs; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE actlogs (
    id integer DEFAULT nextval('actlogs_id_seq'::regclass) NOT NULL,
    pessoa integer NOT NULL,
    modulo character varying(255),
    action character varying(255),
    text text,
    data timestamp(6) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.actlogs OWNER TO postgres;

--
-- Name: eventos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE eventos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.eventos_id_seq OWNER TO postgres;

--
-- Name: eventos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE eventos (
    id integer DEFAULT nextval('eventos_id_seq'::regclass) NOT NULL,
    eventopai integer,
    tipo integer,
    nome character varying(255) NOT NULL,
    resumo text,
    logo text,
    inievento timestamp(6) without time zone DEFAULT now(),
    fimevento timestamp(6) without time zone DEFAULT now(),
    local character varying(255),
    iniinscricao timestamp(6) without time zone DEFAULT now(),
    fiminscricao timestamp(6) without time zone DEFAULT now(),
    sala integer,
    status smallint DEFAULT 0 NOT NULL,
    instituicao integer,
    contato text
);


ALTER TABLE public.eventos OWNER TO postgres;

--
-- Name: inscricoes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE inscricoes (
    pessoa integer NOT NULL,
    evento integer NOT NULL,
    regra integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.inscricoes OWNER TO postgres;

--
-- Name: instituicoes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE instituicoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.instituicoes_id_seq OWNER TO postgres;

--
-- Name: instituicoes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE instituicoes (
    id integer DEFAULT nextval('instituicoes_id_seq'::regclass) NOT NULL,
    nome character varying NOT NULL,
    sigla character varying,
    email character varying,
    telefone character varying,
    status smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.instituicoes OWNER TO postgres;

--
-- Name: logs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE logs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.logs_id_seq OWNER TO postgres;

--
-- Name: logs; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE logs (
    id integer DEFAULT nextval('logs_id_seq'::regclass) NOT NULL,
    action character varying(255),
    text text,
    data character varying(255) DEFAULT now() NOT NULL
);


ALTER TABLE public.logs OWNER TO postgres;

--
-- Name: pessoas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pessoas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pessoas_id_seq OWNER TO postgres;

--
-- Name: pessoas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pessoas (
    id integer DEFAULT nextval('pessoas_id_seq'::regclass) NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    cpf character varying(255),
    login character varying(255) NOT NULL,
    senha character varying(255) NOT NULL,
    regrageral character varying(255) DEFAULT 0 NOT NULL,
    criadoem timestamp(6) without time zone DEFAULT now() NOT NULL,
    status smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.pessoas OWNER TO postgres;

--
-- Name: presencas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE presencas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.presencas_id_seq OWNER TO postgres;

--
-- Name: presencas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE presencas (
    id integer DEFAULT nextval('presencas_id_seq'::regclass) NOT NULL,
    evento integer NOT NULL,
    presente smallint DEFAULT 0 NOT NULL,
    userid integer NOT NULL,
    data timestamp(6) without time zone DEFAULT now() NOT NULL,
    pessoa integer NOT NULL
);


ALTER TABLE public.presencas OWNER TO postgres;

--
-- Name: regras_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE regras_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.regras_id_seq OWNER TO postgres;

--
-- Name: regras; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE regras (
    id integer DEFAULT nextval('regras_id_seq'::regclass) NOT NULL,
    nome character varying(255) NOT NULL,
    descricao text,
    status smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.regras OWNER TO postgres;

--
-- Name: salas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE salas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.salas_id_seq OWNER TO postgres;

--
-- Name: salas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE salas (
    id integer DEFAULT nextval('salas_id_seq'::regclass) NOT NULL,
    nome character varying(255) NOT NULL,
    status smallint DEFAULT 0 NOT NULL,
    capacidade integer DEFAULT 1
);


ALTER TABLE public.salas OWNER TO postgres;

--
-- Name: tipos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_id_seq OWNER TO postgres;

--
-- Name: tipos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipos (
    id integer DEFAULT nextval('tipos_id_seq'::regclass) NOT NULL,
    nome character varying(255),
    status integer DEFAULT 0
);


ALTER TABLE public.tipos OWNER TO postgres;

--
-- Data for Name: actlogs; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO actlogs VALUES (1, 1, 'login', '_login', 'Login = adm', '2013-10-16 20:02:01.32769');
INSERT INTO actlogs VALUES (2, 1, 'login', '_login', 'Login = adm', '2013-10-16 20:05:38.789902');
INSERT INTO actlogs VALUES (3, 1, 'login', '_login', 'Login = adm', '2013-10-16 21:12:25.121673');
INSERT INTO actlogs VALUES (4, 1, 'login', '_login', 'Login = adm', '2013-10-16 21:45:24.796838');
INSERT INTO actlogs VALUES (5, 1, 'login', '_login', 'Login = adm', '2013-10-19 20:09:53.169695');
INSERT INTO actlogs VALUES (6, 1, 'login', '_login', 'Login = adm', '2013-10-21 08:43:14.737055');
INSERT INTO actlogs VALUES (7, 1, 'login', '_login', 'Login = adm', '2013-10-21 08:48:32.066952');
INSERT INTO actlogs VALUES (8, 1, 'login', '_login', 'Login = adm', '2013-10-21 10:02:51.323988');
INSERT INTO actlogs VALUES (9, 1, 'login', '_login', 'Login = adm', '2013-10-21 15:35:04.277201');
INSERT INTO actlogs VALUES (10, 1, 'login', '_login', 'Login = adm', '2013-10-21 19:34:21.159018');
INSERT INTO actlogs VALUES (11, 1, 'login', '_login', 'Login = adm', '2013-10-22 15:38:18.875377');
INSERT INTO actlogs VALUES (12, 1, 'login', '_login', 'Login = adm', '2013-10-22 19:34:04.115173');
INSERT INTO actlogs VALUES (13, 1, 'login', '_login', 'Login = adm', '2013-10-22 19:34:48.649022');
INSERT INTO actlogs VALUES (14, 1, 'login', '_login', 'Login = adm', '2013-10-22 21:27:21.870284');
INSERT INTO actlogs VALUES (15, 1, 'login', '_login', 'Login = adm', '2013-10-24 19:16:42.661655');


--
-- Name: actlogs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('actlogs_id_seq', 15, true);


--
-- Data for Name: eventos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO eventos VALUES (4, 4, 4, 'Seminário Nacional de Testes', 'Este é um exemplo de testes', 'impressao_digital_digital.jpg5269a35ed0e50impressao_digital_digital.jpg', '2013-01-10 00:00:00', '2013-01-10 10:00:00', 'Osório', '2013-10-22 17:01:00', '2013-10-01 07:00:00', 8, 1, 1, 'asdas');
INSERT INTO eventos VALUES (54, 4, 5, 'teste', '', NULL, '2013-01-10 00:00:00', '2013-01-10 10:00:00', '', '2013-01-10 00:00:00', '2013-01-10 00:00:00', NULL, 1, NULL, NULL);


--
-- Name: eventos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('eventos_id_seq', 77, true);


--
-- Data for Name: inscricoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO inscricoes VALUES (109, 4, 8);
INSERT INTO inscricoes VALUES (1, 4, 8);


--
-- Data for Name: instituicoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO instituicoes VALUES (1, 'Instituição de Teste', 'ITE', 'ite@ite.com', 'asdasd', 1);


--
-- Name: instituicoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('instituicoes_id_seq', 24, true);


--
-- Data for Name: logs; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('logs_id_seq', 25, true);


--
-- Data for Name: pessoas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO pessoas VALUES (109, 'Usuario', 'usuario@ser.com', '', 'usu', 'usu', '0', '2013-10-21 10:23:05.110592', 0);
INSERT INTO pessoas VALUES (1, 'Administrador', 'adm@teste.com', '', 'adm', 'adm', '1', '2013-10-16 20:01:56.015973', 0);


--
-- Name: pessoas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pessoas_id_seq', 161, true);


--
-- Data for Name: presencas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO presencas VALUES (8, 4, 1, 1, '2013-10-22 21:34:00.015536', 1);


--
-- Name: presencas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('presencas_id_seq', 8, true);


--
-- Data for Name: regras; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO regras VALUES (8, 'Aluno', 'Papel de Aluno ', 1);
INSERT INTO regras VALUES (9, 'Professor', 'Professor', 1);
INSERT INTO regras VALUES (10, 'Gerente', 'Gerente', 1);
INSERT INTO regras VALUES (126, 'teste', 'sadsaas', 1);


--
-- Name: regras_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('regras_id_seq', 10, true);


--
-- Data for Name: salas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO salas VALUES (8, 'sala 1', 1, 3);


--
-- Name: salas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('salas_id_seq', 19, true);


--
-- Data for Name: tipos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipos VALUES (6, 'Oficina', 0);
INSERT INTO tipos VALUES (3, 'Workshop', 0);
INSERT INTO tipos VALUES (4, 'Seminário', 0);
INSERT INTO tipos VALUES (5, 'Encontro', 0);
INSERT INTO tipos VALUES (2, 'Palestra', 0);


--
-- Name: tipos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipos_id_seq', 40, true);


--
-- Name: instituicoes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY instituicoes
    ADD CONSTRAINT instituicoes_pkey PRIMARY KEY (id);


--
-- Name: presencas_evento_pessoa_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY presencas
    ADD CONSTRAINT presencas_evento_pessoa_key UNIQUE (evento, pessoa);


--
-- Name: presencas_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY presencas
    ADD CONSTRAINT presencas_id_key UNIQUE (id);


--
-- Name: unq_actlogs; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY actlogs
    ADD CONSTRAINT unq_actlogs PRIMARY KEY (id);


--
-- Name: unq_eventos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT unq_eventos PRIMARY KEY (id);


--
-- Name: unq_inscrioes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inscricoes
    ADD CONSTRAINT unq_inscrioes PRIMARY KEY (pessoa, evento, regra);


--
-- Name: unq_instit; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY instituicoes
    ADD CONSTRAINT unq_instit UNIQUE (id, nome);


--
-- Name: unq_logs; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY logs
    ADD CONSTRAINT unq_logs PRIMARY KEY (id);


--
-- Name: unq_pessoas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pessoas
    ADD CONSTRAINT unq_pessoas PRIMARY KEY (id);


--
-- Name: unq_presencas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY presencas
    ADD CONSTRAINT unq_presencas PRIMARY KEY (id);


--
-- Name: unq_regras; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY regras
    ADD CONSTRAINT unq_regras PRIMARY KEY (id);


--
-- Name: unq_salas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY salas
    ADD CONSTRAINT unq_salas PRIMARY KEY (id);


--
-- Name: unq_tipos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipos
    ADD CONSTRAINT unq_tipos PRIMARY KEY (id);


--
-- Name: idx_actlogs; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_actlogs ON actlogs USING btree (id, pessoa, modulo, action);


--
-- Name: idx_eventos; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_eventos ON eventos USING btree (id, eventopai);


--
-- Name: idx_instit; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_instit ON instituicoes USING btree (id);


--
-- Name: idx_logs; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_logs ON logs USING btree (id, action);


--
-- Name: idx_pessoa_evento_regra; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_pessoa_evento_regra ON inscricoes USING btree (pessoa, evento, regra);


--
-- Name: idx_pessoas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_pessoas ON pessoas USING btree (id, email);


--
-- Name: idx_presencas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_presencas ON presencas USING btree (id);


--
-- Name: idx_regras; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_regras ON regras USING btree (id, nome, descricao);


--
-- Name: idx_salas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_salas ON salas USING btree (id, nome);


--
-- Name: idx_tipos; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_tipos ON tipos USING btree (id, nome);


--
-- Name: fk_actlogs_pessoas_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY actlogs
    ADD CONSTRAINT fk_actlogs_pessoas_1 FOREIGN KEY (pessoa) REFERENCES pessoas(id);


--
-- Name: fk_eventos_eventos_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT fk_eventos_eventos_1 FOREIGN KEY (eventopai) REFERENCES eventos(id);


--
-- Name: fk_eventos_salas_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT fk_eventos_salas_1 FOREIGN KEY (sala) REFERENCES salas(id);


--
-- Name: fk_eventos_tipos_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT fk_eventos_tipos_1 FOREIGN KEY (tipo) REFERENCES tipos(id);


--
-- Name: fk_inscricoes_eventos_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inscricoes
    ADD CONSTRAINT fk_inscricoes_eventos_1 FOREIGN KEY (evento) REFERENCES eventos(id);


--
-- Name: fk_inscricoes_pessoas_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inscricoes
    ADD CONSTRAINT fk_inscricoes_pessoas_1 FOREIGN KEY (pessoa) REFERENCES pessoas(id);


--
-- Name: fk_inscricoes_regras_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inscricoes
    ADD CONSTRAINT fk_inscricoes_regras_1 FOREIGN KEY (regra) REFERENCES regras(id);


--
-- Name: fk_instituicoes; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT fk_instituicoes FOREIGN KEY (instituicao) REFERENCES instituicoes(id);


--
-- Name: fk_presencas_eventos_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY presencas
    ADD CONSTRAINT fk_presencas_eventos_1 FOREIGN KEY (evento) REFERENCES eventos(id);


--
-- Name: fk_presencas_pessoa; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY presencas
    ADD CONSTRAINT fk_presencas_pessoa FOREIGN KEY (pessoa) REFERENCES pessoas(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

