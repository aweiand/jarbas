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

INSERT INTO actlogs VALUES (19, 1, 'login', '_login', 'Login = adm', '2013-10-25 14:18:32.885916');
INSERT INTO actlogs VALUES (20, 109, 'login', '_login', 'Login = usu', '2013-10-25 14:19:43.795772');
INSERT INTO actlogs VALUES (21, 1, 'login', '_login', 'Login = adm', '2013-10-27 16:19:37.137715');
INSERT INTO actlogs VALUES (22, 1, 'login', '_login', 'Login = adm', '2013-11-01 11:54:11.219583');
INSERT INTO actlogs VALUES (23, 1, 'login', '_login', 'Login = adm', '2013-11-05 19:07:32.622993');
INSERT INTO actlogs VALUES (24, 1, 'login', '_login', 'Login = adm', '2013-11-05 20:04:21.268599');
INSERT INTO actlogs VALUES (25, 1, 'login', '_login', 'Login = adm', '2013-12-22 16:18:37.770687');
INSERT INTO actlogs VALUES (26, 1, 'login', '_login', 'Login = adm', '2013-12-22 16:27:54.88027');
INSERT INTO actlogs VALUES (27, 109, 'login', '_login', 'Login = usu', '2013-12-22 16:28:28.691164');
INSERT INTO actlogs VALUES (28, 1, 'login', '_login', 'Login = adm', '2013-12-22 16:36:20.371832');
INSERT INTO actlogs VALUES (29, 1, 'login', '_login', 'Login = adm', '2013-12-22 16:36:54.771969');
INSERT INTO actlogs VALUES (30, 1, 'login', '_login', 'Login = adm', '2013-12-22 16:37:05.500831');
INSERT INTO actlogs VALUES (31, 109, 'login', '_login', 'Login = usu', '2013-12-22 16:37:50.918304');
INSERT INTO actlogs VALUES (33, 1, 'login', '_login', 'Login = adm', '2013-12-22 16:40:54.058267');
INSERT INTO actlogs VALUES (34, 1, 'login', '_login', 'Login = adm', '2013-12-22 17:30:15.78403');
INSERT INTO actlogs VALUES (35, 1, 'login', '_login', 'Login = adm', '2013-12-22 17:38:52.770527');
INSERT INTO actlogs VALUES (36, 1, 'login', '_login', 'Login = adm', '2013-12-22 17:54:49.59024');
INSERT INTO actlogs VALUES (37, 1, 'login', '_login', 'Login = adm', '2013-12-22 18:14:44.099942');
INSERT INTO actlogs VALUES (38, 1, 'login', '_login', 'Login = adm', '2013-12-28 19:06:34.29744');
INSERT INTO actlogs VALUES (39, 1, 'login', '_login', 'Login = adm', '2013-12-30 10:57:03.65028');
INSERT INTO actlogs VALUES (41, 1, 'login', '_login', 'Login = adm', '2013-12-30 10:57:03.651357');
INSERT INTO actlogs VALUES (40, 1, 'login', '_login', 'Login = adm', '2013-12-30 10:57:03.651228');
INSERT INTO actlogs VALUES (42, 1, 'login', '_login', 'Login = adm', '2013-12-30 13:25:06.517953');


--
-- Name: actlogs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('actlogs_id_seq', 42, true);


--
-- Data for Name: eventos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO eventos VALUES (99, 98, 6, 'Oficina PROA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu ante vehicula, porttitor tellus et, blandit felis. Aliquam ut eros egestas libero posuere pretium. Nunc dictum a justo quis luctus. Nunc adipiscing dolor viverra laoreet tincidunt. Phasellus rutrum metus sed ante viverra placerat. Pellentesque tempor metus ut turpis tempor vestibulum. Quisque nec lacus lacus. Aenean non neque sed nibh posuere lacinia in sed est.', NULL, '2013-12-10 00:00:00', '2013-12-10 12:00:00', 'Osório', '2013-12-01 00:00:00', '2013-12-08 00:00:00', 25, 1, 1, '');
INSERT INTO eventos VALUES (109, NULL, 42, 'Defesa do Projeto', 'Sed a facilisis sem. Sed viverra, diam ut volutpat blandit, lorem purus varius dui, eu faucibus tellus lectus viverra quam. Proin consequat eu orci non gravida. Praesent vitae tortor nunc. Fusce placerat blandit ligula. Sed volutpat mi dui, id vestibulum nulla mollis in. Nam vel lorem at nulla tempor viverra vel eget augue. Maecenas nisl velit, mollis adipiscing ullamcorper sit amet, ultricies eu mi. Aenean at ultricies enim. Morbi porta mi sed massa egestas, in pretium nunc semper. Suspendisse facilisis sed velit quis dapibus. Nunc non odio et urna faucibus pharetra. Nam nulla est, varius vel velit suscipit, porta tincidunt libero. Vivamus elementum purus ac cursus pellentesque.', NULL, '2014-01-08 00:00:00', '2014-01-08 23:59:00', 'Osório', '2013-01-01 00:00:00', '2014-01-31 00:00:00', NULL, 1, 31, '');
INSERT INTO eventos VALUES (81, 4, 42, 'Maratona de Programação', 'Donec tortor felis, sodales aliquam consequat ac, tincidunt vitae dui. Pellentesque a odio mauris. Duis eget velit in justo consectetur mattis a quis nulla. Donec fermentum condimentum nulla quis volutpat. Suspendisse bibendum faucibus leo, in faucibus augue condimentum id. In dolor nibh, eleifend at est ut, pulvinar facilisis tortor. Nunc condimentum enim in vulputate ultricies. Fusce placerat neque convallis lorem porta vehicula. Praesent tempus condimentum dapibus. Duis aliquam molestie ultricies. Curabitur eu orci faucibus, dictum ante egestas, venenatis sem. Etiam faucibus sed dolor vitae pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', NULL, '2013-10-23 19:00:00', '2013-10-23 22:00:00', 'Osório', '2013-10-14 00:00:00', '2013-10-21 00:00:00', 20, 1, 1, '');
INSERT INTO eventos VALUES (54, 4, 6, 'Desenvolvendo Apps para Android', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ullamcorper facilisis diam at placerat. Nam eleifend dignissim mauris quis tempus. Quisque sodales justo vitae sapien varius, in mattis risus iaculis. Suspendisse vulputate sapien fermentum est consequat, a luctus dui egestas. Quisque neque leo, lobortis at lorem vel, euismod euismod dolor. Fusce id dolor eget odio tempus condimentum ut id odio. Ut eget pretium ante. Morbi nunc lacus, malesuada a sem sit amet, mattis accumsan urna. In vel faucibus nulla. Nam rutrum luctus elit dignissim feugiat. Duis sagittis lobortis tellus ac aliquam. Nullam at mi ac nisl tincidunt sodales id sit amet nunc. Quisque aliquam, arcu quis bibendum lobortis, erat diam lobortis libero, eget porta nisi ipsum sit amet nisi.', NULL, '2013-01-22 19:00:00', '2013-01-22 22:00:00', 'Osório', '2013-10-14 00:00:00', '2013-12-29 00:00:00', 8, 1, 1, '');
INSERT INTO eventos VALUES (4, NULL, 41, 'Semana Acadêmica do Curso de Licenciatura em Informática', 'Pellentesque imperdiet leo congue ligula vulputate ullamcorper. In vel sapien vel neque eleifend facilisis. Fusce pulvinar id orci vitae adipiscing. Vivamus semper auctor lacus. Nunc sit amet commodo nisi, a tempus odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce pellentesque vel ligula sagittis vestibulum. Sed at mattis velit. Proin suscipit, diam et imperdiet commodo, lorem dolor condimentum urna, non congue orci augue non libero.', NULL, '2013-01-22 00:00:00', '2013-01-24 00:00:00', 'Osório', '2013-10-14 00:00:00', '2013-10-21 00:00:00', NULL, 1, 1, '');
INSERT INTO eventos VALUES (98, NULL, 4, '1º Seminário PIBID da Informática', 'Duis ultrices, nisl quis imperdiet interdum, purus libero sagittis turpis, et ullamcorper metus neque non nibh. Nunc ullamcorper rhoncus metus at vehicula. Nunc et mollis ligula. Vivamus sed neque volutpat risus tempus molestie porttitor eu lorem. Proin id consequat arcu, ultrices convallis purus. Praesent cursus leo a diam cursus faucibus. In dui ipsum, elementum ut ipsum ac, condimentum lobortis est. Maecenas semper mauris id nisi porta tincidunt. Suspendisse elementum nulla sed orci venenatis ultrices. Curabitur accumsan elit id venenatis aliquet. Quisque imperdiet dapibus augue ut ornare. Vestibulum faucibus quis tortor at ullamcorper. Proin eget consectetur nisi. Nulla ante leo, pharetra in eleifend ut, blandit suscipit ligula.', NULL, '2013-12-10 00:00:00', '2013-12-31 00:00:00', 'Osório', '2013-12-01 00:00:00', '2013-12-08 00:00:00', NULL, 1, 1, '');
INSERT INTO eventos VALUES (103, 98, 2, 'Mesa Redonda', 'Sed et lacus eu ante fermentum pretium sed eu velit. Duis augue nisl, tincidunt vitae ornare nec, scelerisque imperdiet arcu. Donec erat nunc, rutrum eget pretium vel, hendrerit nec neque. Maecenas at volutpat justo, in mollis enim. Vivamus eu suscipit lacus, id venenatis felis. Fusce fermentum urna eu justo condimentum rhoncus. Cras sit amet libero in justo rutrum consequat in non diam. Suspendisse condimentum porta feugiat. Vestibulum faucibus est ut arcu tincidunt, ut interdum nisl facilisis.', NULL, '2013-12-12 00:00:00', '2013-12-12 12:00:00', 'Osório', '2013-12-01 00:00:00', '2013-12-08 00:00:00', 28, 1, 1, '');
INSERT INTO eventos VALUES (110, 109, 42, 'Defesa Jarbas', 'Sed magna arcu, mattis eu massa ac, tempor sollicitudin magna. Maecenas pellentesque, lectus non pulvinar egestas, magna lacus auctor est, sed volutpat lorem mauris eget ante. Duis pellentesque nec arcu vitae sollicitudin. Fusce suscipit tellus nec rhoncus congue. Proin tristique risus in tortor blandit imperdiet. Duis a fermentum turpis. Suspendisse rutrum tempus elementum. Integer sed urna aliquet, imperdiet dui in, mollis dui. Ut elementum orci sed urna dictum, eu feugiat lectus pellentesque.', NULL, '2014-01-08 00:00:00', '2014-01-08 23:59:00', 'Osório', '2014-01-08 00:00:00', '2014-01-08 23:59:00', 8, 1, 31, '');
INSERT INTO eventos VALUES (82, 4, 45, 'Salchipão', 'Nulla pharetra erat eu leo pretium, eu adipiscing nisi luctus. Donec sodales eros condimentum enim mollis fermentum. Phasellus consequat elementum neque. Ut eleifend ligula id metus elementum varius. Cras sit amet magna tellus. Quisque iaculis velit et nisi euismod vestibulum. Vivamus eu ornare lacus. Duis non dapibus enim, vel viverra sem. Etiam ullamcorper est nec nulla bibendum, nec pulvinar eros semper. Ut gravida turpis vel magna rutrum porttitor. Donec fermentum diam a iaculis imperdiet.', NULL, '2013-10-24 20:00:00', '2013-10-24 23:00:00', 'Osório', '2013-10-14 00:00:00', '2013-10-21 00:00:00', 29, 1, 1, NULL);


--
-- Name: eventos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('eventos_id_seq', 111, true);


--
-- Data for Name: inscricoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO inscricoes VALUES (1, 103, 8);
INSERT INTO inscricoes VALUES (1, 99, 8);
INSERT INTO inscricoes VALUES (1, 110, 8);
INSERT INTO inscricoes VALUES (1, 99, 9);
INSERT INTO inscricoes VALUES (1, 81, 8);


--
-- Data for Name: instituicoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO instituicoes VALUES (1, 'Faculdade Cenecista de Osório', 'FACOS', 'facos@teste.com', '51.2161-0200', 1);
INSERT INTO instituicoes VALUES (31, 'Instituto Federal do Rio Grande do Sul', 'IFRS', 'ifrs@ifrs.gov.br', '51.1111-1111', 1);


--
-- Name: instituicoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('instituicoes_id_seq', 31, true);


--
-- Data for Name: logs; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('logs_id_seq', 34, true);


--
-- Data for Name: pessoas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO pessoas VALUES (109, 'Usuario', 'usuario@ser.com', '', 'usu', 'usu', '0', '2013-10-21 10:23:05.110592', 0);
INSERT INTO pessoas VALUES (1, 'Administrador', 'adm@teste.com', '11111111111', 'adm', 'adm', '1', '2013-10-16 20:01:56.015973', 0);


--
-- Name: pessoas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pessoas_id_seq', 218, true);


--
-- Data for Name: presencas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO presencas VALUES (14, 110, 1, 1, '2013-12-30 13:41:24.645283', 1);
INSERT INTO presencas VALUES (15, 99, 1, 1, '2013-12-30 13:41:35.604741', 1);


--
-- Name: presencas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('presencas_id_seq', 15, true);


--
-- Data for Name: regras; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO regras VALUES (8, 'Aluno', 'Papel de Aluno ', 1);
INSERT INTO regras VALUES (9, 'Professor', 'Professor', 1);
INSERT INTO regras VALUES (10, 'Gerente', 'Gerente', 1);
INSERT INTO regras VALUES (126, 'Ouvinte', 'Ouvinte', 1);


--
-- Name: regras_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('regras_id_seq', 10, true);


--
-- Data for Name: salas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO salas VALUES (20, 'Laboratório 2', 0, 20);
INSERT INTO salas VALUES (21, 'Laboratório 3', 0, 20);
INSERT INTO salas VALUES (22, 'Laboratório 4', 0, 20);
INSERT INTO salas VALUES (23, 'Laboratório 5', 0, 20);
INSERT INTO salas VALUES (24, 'Laboratório 6', 0, 20);
INSERT INTO salas VALUES (25, 'Laboratório 7', 0, 20);
INSERT INTO salas VALUES (26, 'Laboratório 8', 0, 20);
INSERT INTO salas VALUES (8, 'Laboratório 1', 0, 20);
INSERT INTO salas VALUES (27, 'Sala Multiuso', 0, 100);
INSERT INTO salas VALUES (28, 'Auditório', 0, 200);
INSERT INTO salas VALUES (29, 'Salão de Festas', 0, 300);


--
-- Name: salas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('salas_id_seq', 40, true);


--
-- Data for Name: tipos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipos VALUES (6, 'Oficina', 0);
INSERT INTO tipos VALUES (3, 'Workshop', 0);
INSERT INTO tipos VALUES (4, 'Seminário', 0);
INSERT INTO tipos VALUES (5, 'Encontro', 0);
INSERT INTO tipos VALUES (2, 'Palestra', 0);
INSERT INTO tipos VALUES (41, 'Semana', 0);
INSERT INTO tipos VALUES (42, 'Hand''s On', 0);
INSERT INTO tipos VALUES (43, 'Hackaton', 0);
INSERT INTO tipos VALUES (45, 'Confraternização', 0);


--
-- Name: tipos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipos_id_seq', 52, true);


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

