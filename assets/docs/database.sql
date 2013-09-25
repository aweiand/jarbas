CREATE TABLE "pessoas" (
"id" int4 NOT NULL DEFAULT nextval('pessoas_id_seq'),
"nome" varchar(255) NOT NULL,
"email" varchar(255) NOT NULL,
"cpf" varchar,
"login" varchar(255) NOT NULL,
"senha" varchar(255) NOT NULL,
"regrageral" varchar(255) NOT NULL DEFAULT 0,
"criadoem" timestamp(255) NOT NULL DEFAULT NOW(),
"status" int2 NOT NULL DEFAULT 0,
PRIMARY KEY ("id") ,
CONSTRAINT "unq_pessoas" UNIQUE ("id")
);

CREATE UNIQUE INDEX "idx_pessoas" ON "pessoas" ("id", "email");

CREATE TABLE "inscricoes" (
"pessoa" int4 NOT NULL,
"evento" int4 NOT NULL,
"regra" int4 NOT NULL DEFAULT 0,
PRIMARY KEY ("pessoa", "evento") ,
CONSTRAINT "unq_inscrioes" UNIQUE ("pessoa", "evento")
);

CREATE UNIQUE INDEX "idx_inscricoes" ON "inscricoes" ("pessoa", "evento");

CREATE TABLE "eventos" (
"id" int4 NOT NULL DEFAULT nextval('eventos_id_seq'),
"eventopai" int4 DEFAULT NULL,
"tipo" int4,
"nome" varchar(255) NOT NULL,
"resumo" text,
"logo" text,
"inievento" timestamp(255) NOT NULL DEFAULT NOW(),
"fimevento" timestamp(255) NOT NULL DEFAULT NOW(),
"local" varchar(255),
"iniinscricao" timestamp(255) NOT NULL DEFAULT NOW(),
"fiminscricao" timestamp(255) NOT NULL DEFAULT NOW(),
"sala" int4,
"status" int2 NOT NULL DEFAULT 0,
PRIMARY KEY ("id") ,
CONSTRAINT "unq_eventos" UNIQUE ("id")
);

CREATE INDEX "idx_eventos" ON "eventos" ("id", "eventopai");

CREATE TABLE "logs" (
"id" int4 NOT NULL DEFAULT nextval('logs_id_seq'),
"action" varchar(255),
"text" text,
"data" varchar(255) NOT NULL DEFAULT NOW(),
PRIMARY KEY ("id") ,
CONSTRAINT "unq_logs" UNIQUE ("id")
);

CREATE INDEX "idx_logs" ON "logs" ("id", "action");

CREATE TABLE "actlogs" (
"id" int4 NOT NULL DEFAULT nextval('actlogs_id_seq'),
"pessoa" int4 NOT NULL,
"modulo" varchar(255),
"action" varchar(255),
"text" text,
"data" timestamp(255) NOT NULL DEFAULT NOW(),
PRIMARY KEY ("id") ,
CONSTRAINT "unq_actlogs" UNIQUE ("id")
);

CREATE INDEX "idx_actlogs" ON "actlogs" ("id", "pessoa", "modulo", "action");

CREATE TABLE "presencas" (
"id" int4 NOT NULL DEFAULT nextval('presencas_id_seq'),
"evento" int4 NOT NULL,
"pessoa" varchar(255) NOT NULL,
"presente" int2 NOT NULL DEFAULT 0,
"userid" int4 NOT NULL,
"data" timestamp(255) NOT NULL DEFAULT now(),
PRIMARY KEY ("id") ,
CONSTRAINT "unq_presencas" UNIQUE ("id")
);

CREATE INDEX "idx_presencas" ON "presencas" ("id", "evento", "pessoa");

CREATE TABLE "regras" (
"id" int4 NOT NULL DEFAULT nextval('regras_id_seq'),
"nome" varchar(255) NOT NULL,
"descricao" text,
"status" int2 NOT NULL DEFAULT 0,
PRIMARY KEY ("id") ,
CONSTRAINT "unq_regras" UNIQUE ("id")
);

CREATE INDEX "idx_regras" ON "regras" ("id", "nome", "descricao");

CREATE TABLE "salas" (
"id" int4 NOT NULL DEFAULT nextval('salas_id_seq'),
"nome" varchar(255) NOT NULL,
"status" int2 NOT NULL DEFAULT 0,
PRIMARY KEY ("id") ,
CONSTRAINT "unq_salas" UNIQUE ("id")
);

CREATE UNIQUE INDEX "idx_salas" ON "salas" ("id", "nome");

CREATE TABLE "tipos" (
"id" int4 NOT NULL DEFAULT nextval('tipos_id_seq'),
"nome" varchar(255),
"status" int4 DEFAULT 0,
PRIMARY KEY ("id") ,
CONSTRAINT "unq_tipos" UNIQUE ("id")
);

CREATE INDEX "idx_tipos" ON "tipos" ("id", "nome");


ALTER TABLE "inscricoes" ADD CONSTRAINT "fk_inscricoes_pessoas_1" FOREIGN KEY ("pessoa") REFERENCES "pessoas" ("id");
ALTER TABLE "inscricoes" ADD CONSTRAINT "fk_inscricoes_eventos_1" FOREIGN KEY ("evento") REFERENCES "eventos" ("id");
ALTER TABLE "eventos" ADD CONSTRAINT "fk_eventos_eventos_1" FOREIGN KEY ("eventopai") REFERENCES "eventos" ("id");
ALTER TABLE "presencas" ADD CONSTRAINT "fk_presencas_eventos_1" FOREIGN KEY ("evento") REFERENCES "eventos" ("id");
ALTER TABLE "eventos" ADD CONSTRAINT "fk_eventos_salas_1" FOREIGN KEY ("sala") REFERENCES "salas" ("id");
ALTER TABLE "actlogs" ADD CONSTRAINT "fk_actlogs_pessoas_1" FOREIGN KEY ("pessoa") REFERENCES "pessoas" ("id");
ALTER TABLE "inscricoes" ADD CONSTRAINT "fk_inscricoes_regras_1" FOREIGN KEY ("regra") REFERENCES "regras" ("id");
ALTER TABLE "eventos" ADD CONSTRAINT "fk_eventos_tipos_1" FOREIGN KEY ("tipo") REFERENCES "tipos" ("id");

