--
-- PostgreSQL database dump
--

-- Dumped from database version 14.3 (Debian 14.3-1.pgdg100+1)
-- Dumped by pg_dump version 14.3 (Debian 14.3-1.pgdg100+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: artistas; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.artistas (
    artista_id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    apellido character varying(50) NOT NULL,
    pais_nacimiento character varying(50) NOT NULL,
    fecha_nacimiento date NOT NULL,
    nombre_artistico character varying(50)
);


ALTER TABLE public.artistas OWNER TO discos_dbo;

--
-- Name: artistas_artista_id_seq; Type: SEQUENCE; Schema: public; Owner: discos_dbo
--

CREATE SEQUENCE public.artistas_artista_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.artistas_artista_id_seq OWNER TO discos_dbo;

--
-- Name: artistas_artista_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: discos_dbo
--

ALTER SEQUENCE public.artistas_artista_id_seq OWNED BY public.artistas.artista_id;


--
-- Name: cancion_compositor; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.cancion_compositor (
    cancion_id integer NOT NULL,
    compositor_id integer NOT NULL
);


ALTER TABLE public.cancion_compositor OWNER TO discos_dbo;

--
-- Name: canciones; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.canciones (
    cancion_id integer NOT NULL,
    titulo character varying(50) NOT NULL
);


ALTER TABLE public.canciones OWNER TO discos_dbo;

--
-- Name: canciones_cancion_id_seq; Type: SEQUENCE; Schema: public; Owner: discos_dbo
--

CREATE SEQUENCE public.canciones_cancion_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.canciones_cancion_id_seq OWNER TO discos_dbo;

--
-- Name: canciones_cancion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: discos_dbo
--

ALTER SEQUENCE public.canciones_cancion_id_seq OWNED BY public.canciones.cancion_id;


--
-- Name: compositores; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.compositores (
    compositor_id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    apellido character varying(50) NOT NULL,
    pais_nacimiento character varying(50) NOT NULL,
    fecha_nacimiento date NOT NULL
);


ALTER TABLE public.compositores OWNER TO discos_dbo;

--
-- Name: disco_cancion; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.disco_cancion (
    disco_id integer NOT NULL,
    cancion_id integer NOT NULL
);


ALTER TABLE public.disco_cancion OWNER TO discos_dbo;

--
-- Name: discos; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.discos (
    disco_id integer NOT NULL,
    titulo character varying(50) NOT NULL,
    grupo_id integer NOT NULL,
    "año" date NOT NULL,
    genero character varying(50) NOT NULL,
    disquera_id integer NOT NULL,
    productor_id integer NOT NULL,
    costo numeric NOT NULL,
    portada character varying(200)
);


ALTER TABLE public.discos OWNER TO discos_dbo;

--
-- Name: grupos; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.grupos (
    grupo_id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    pais_origen character varying(50) NOT NULL
);


ALTER TABLE public.grupos OWNER TO discos_dbo;

--
-- Name: catalogo_cancion; Type: VIEW; Schema: public; Owner: discos_dbo
--

CREATE VIEW public.catalogo_cancion AS
 SELECT d.disco_id,
    d.titulo,
    d.portada,
    g.nombre AS grupo,
    c.titulo AS cancion,
    (((c2.nombre)::text || ' '::text) || (c2.apellido)::text) AS compositor
   FROM (((((public.discos d
     JOIN public.disco_cancion dc ON ((d.disco_id = dc.disco_id)))
     JOIN public.canciones c ON ((dc.cancion_id = c.cancion_id)))
     JOIN public.cancion_compositor cc ON ((c.cancion_id = cc.cancion_id)))
     JOIN public.compositores c2 ON ((cc.compositor_id = c2.compositor_id)))
     JOIN public.grupos g ON ((d.grupo_id = g.grupo_id)));


ALTER TABLE public.catalogo_cancion OWNER TO discos_dbo;

--
-- Name: compositores_compositor_id_seq; Type: SEQUENCE; Schema: public; Owner: discos_dbo
--

CREATE SEQUENCE public.compositores_compositor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.compositores_compositor_id_seq OWNER TO discos_dbo;

--
-- Name: compositores_compositor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: discos_dbo
--

ALTER SEQUENCE public.compositores_compositor_id_seq OWNED BY public.compositores.compositor_id;


--
-- Name: discos_disco_id_seq; Type: SEQUENCE; Schema: public; Owner: discos_dbo
--

CREATE SEQUENCE public.discos_disco_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.discos_disco_id_seq OWNER TO discos_dbo;

--
-- Name: discos_disco_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: discos_dbo
--

ALTER SEQUENCE public.discos_disco_id_seq OWNED BY public.discos.disco_id;


--
-- Name: disqueras; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.disqueras (
    disquera_id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    pais character varying(50) NOT NULL
);


ALTER TABLE public.disqueras OWNER TO discos_dbo;

--
-- Name: disqueras_disquera_id_seq; Type: SEQUENCE; Schema: public; Owner: discos_dbo
--

CREATE SEQUENCE public.disqueras_disquera_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.disqueras_disquera_id_seq OWNER TO discos_dbo;

--
-- Name: disqueras_disquera_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: discos_dbo
--

ALTER SEQUENCE public.disqueras_disquera_id_seq OWNED BY public.disqueras.disquera_id;


--
-- Name: grupo_artista; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.grupo_artista (
    artista_id integer NOT NULL,
    grupo_id integer NOT NULL
);


ALTER TABLE public.grupo_artista OWNER TO discos_dbo;

--
-- Name: grupos_grupo_id_seq; Type: SEQUENCE; Schema: public; Owner: discos_dbo
--

CREATE SEQUENCE public.grupos_grupo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupos_grupo_id_seq OWNER TO discos_dbo;

--
-- Name: grupos_grupo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: discos_dbo
--

ALTER SEQUENCE public.grupos_grupo_id_seq OWNED BY public.grupos.grupo_id;


--
-- Name: productores; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.productores (
    productor_id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    apellido character varying(50) NOT NULL,
    fecha_nacimiento date NOT NULL
);


ALTER TABLE public.productores OWNER TO discos_dbo;

--
-- Name: productores_productor_id_seq; Type: SEQUENCE; Schema: public; Owner: discos_dbo
--

CREATE SEQUENCE public.productores_productor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.productores_productor_id_seq OWNER TO discos_dbo;

--
-- Name: productores_productor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: discos_dbo
--

ALTER SEQUENCE public.productores_productor_id_seq OWNED BY public.productores.productor_id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: discos_dbo
--

CREATE TABLE public.usuario (
    id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    apaterno character varying(50) NOT NULL,
    amaterno character varying(50) NOT NULL,
    correo character varying(50),
    telefono character varying(10),
    usuario character varying(50) NOT NULL,
    contrasena character varying(66) NOT NULL
);


ALTER TABLE public.usuario OWNER TO discos_dbo;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: discos_dbo
--

CREATE SEQUENCE public.usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO discos_dbo;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: discos_dbo
--

ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;


--
-- Name: artistas artista_id; Type: DEFAULT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.artistas ALTER COLUMN artista_id SET DEFAULT nextval('public.artistas_artista_id_seq'::regclass);


--
-- Name: canciones cancion_id; Type: DEFAULT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.canciones ALTER COLUMN cancion_id SET DEFAULT nextval('public.canciones_cancion_id_seq'::regclass);


--
-- Name: compositores compositor_id; Type: DEFAULT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.compositores ALTER COLUMN compositor_id SET DEFAULT nextval('public.compositores_compositor_id_seq'::regclass);


--
-- Name: discos disco_id; Type: DEFAULT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.discos ALTER COLUMN disco_id SET DEFAULT nextval('public.discos_disco_id_seq'::regclass);


--
-- Name: disqueras disquera_id; Type: DEFAULT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.disqueras ALTER COLUMN disquera_id SET DEFAULT nextval('public.disqueras_disquera_id_seq'::regclass);


--
-- Name: grupos grupo_id; Type: DEFAULT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.grupos ALTER COLUMN grupo_id SET DEFAULT nextval('public.grupos_grupo_id_seq'::regclass);


--
-- Name: productores productor_id; Type: DEFAULT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.productores ALTER COLUMN productor_id SET DEFAULT nextval('public.productores_productor_id_seq'::regclass);


--
-- Name: usuario id; Type: DEFAULT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);


--
-- Data for Name: artistas; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.artistas (artista_id, nombre, apellido, pais_nacimiento, fecha_nacimiento, nombre_artistico) FROM stdin;
1	Ruben	Albarran	México	2067-02-01	Cosme
2	Leon Ruben	Larregui Marin	México	1973-12-01	\N
3	Alvaro Gonzalo	Lopez Parra	Chile	1979-11-04	\N
4	Enrique	Rangel	México	1973-11-09	\N
5	Alvaro	Arizaleta	España	1980-10-05	\N
6	Alfonso	Pichardo	México	1973-02-01	\N
7	Enrique	Ortiz de Land·zuri Yzarduy	España	2067-08-11	Enrique Bunbury
8	Christopher Anthony 	John Martin	Inglaterra	1977-03-02	Chris Martin
9	Edward Louis	Severson	Estados Unidos	2064-12-23	Eddy Vedder
10	Ximena	Sariñana	México	1985-10-20	\N
11	Adrian	Dargelos	Argentina	2069-01-03	\N
12	Juan Alfredo	Baleiron	Argentina	2065-03-11	Juanchi
13	James Douglas	Morrison Clarke	Estados Unidos	2043-12-08	Jim Morrison
14	William Bruce	Rose	Estados Unidos	2062-02-06	Axl Rose
15	Saul	Hudson	Inglaterra	2065-07-23	Slash
16	James Patrick	Page	Inglaterra	2044-01-09	Jimmy Page
17	Robert Anthony	Plant	Inglaterra	2048-08-20	Robert Plant
18	James Marshall	Hendrix	Estados Unidos	2042-11-17	Jimi Hendrix
19	Janis Lyn	Joplin	Estados Unidos	2043-01-19	Janis Joplin
20	Robert Allen	Zimmerman	Estados Unidos	2041-05-25	Bob Dylan
21	Michael Philip	Jagger	Inglaterra	2043-07-26	Mick Jagger
22	Charles Robert	Watts	Inglaterra	2041-06-02	Charlie Watts
23	John Winston	Lennon	Inglaterra	2040-10-09	John Lennon
24	Mariska	Veres	Países Bajos	2047-10-01	Mariska Veres
25	Anthony	Kiedis	Estados Unidos	2062-11-01	Anthony Kiedis
26	David Jon	Gilmour	Inglaterra	2043-03-06	David Gilmour
27	George Roger	Waters	Inglaterra	2046-09-06	Roger Waters
28	James Paul	McCartney	Inglaterra	2042-06-18	Paul McCartney
29	Richard Henri Parkin	Starkey	Inglaterra	2040-07-07	Rin Starr
30	John Cameron	Fogerty	Estados Unidos	2045-05-08	John Fogerty
31	Ray	Manzerak	Inglaterra	2045-02-18	\N
32	Santi	Balmes	España	1975-10-15	\N
33	Jordi	Roig	España	1975-09-09	\N
\.


--
-- Data for Name: cancion_compositor; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.cancion_compositor (cancion_id, compositor_id) FROM stdin;
1	1
2	2
3	3
4	2
5	4
6	5
7	5
8	6
9	7
10	8
11	9
12	10
13	11
14	12
16	15
23	16
29	17
15	17
19	18
20	18
28	19
27	20
31	21
26	21
25	22
\.


--
-- Data for Name: canciones; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.canciones (cancion_id, titulo) FROM stdin;
1	Seguir Siendo
2	Mars 200
3	Ven Aqui
4	Beat reaker
5	Como la flor
6	Perlas
7	Toro
8	Contigo estaré
9	La chispa adecuada
10	Green eyes
11	Yellow Ledbetter
12	No vuelvo mas
13	Pijamas
14	Runaway
15	Dead Horse
16	My generation
17	Peace Frog
18	Tutti Frutti
19	Immigrant Song
20	Dyer Maker
21	Mave On
22	Knockin On Heavens Door
23	Paint it Black
24	The Zephyr Song
25	Venus
26	I Saw Her Standing There
27	How i wish you were here
28	Have You Ever Seen the Rain?
29	Garden of eden
30	Roadhouse Blues
31	Twist and Shout
32	Purple Haze
33	Foxy Lady
\.


--
-- Data for Name: compositores; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.compositores (compositor_id, nombre, apellido, pais_nacimiento, fecha_nacimiento) FROM stdin;
1	Enrique	Rangel	Mexico	1950-01-01
2	Jesus	Baez	Mexico	1968-01-01
3	Victor	Jara	Chile	1965-08-12
4	Abraham	Quintanilla	Texas	1971-04-12
5	Raúl	Arizaleta	España	1971-06-11
6	JuanCarlos	Lozano	Mexico	1968-09-04
7	Enrique	Bunbury	España	1967-08-11
8	Chris	Martin	Inglaterra	1977-03-02
9	Ximena	Sariñana	Mexico	1985-10-10
10	Gabriel	Manelli	Argentina	1968-09-02
11	Consuelo	Velázquez	Mexico	1916-06-06
12	PeterDennis	Blandford	Inglaterra	1945-05-09
13	MichaelPhilip	Jagger	Inglaterra	1943-07-06
14	WilliamBruce	Rose	EstadosUnidos	1962-02-06
15	JamesPatrick	Page	Inglaterra	1944-01-09
16	JohnCameron	Fogerty	EstadosUnidos	1945-05-08
17	DavidJon	Gilmour	Inglaterra	1946-03-06
18	Paul	McCartney	Inglaterra	1942-06-01
19	Robbievan	Leeuwen	Países Bajos	1944-10-02
20	Ruben	Albarran	México	1967-02-01
21	Leon Ruben	Larregui Marin	México	1973-12-01
22	Alvaro	Arizaleta	España	1980-10-05
23	Enrique	Ortiz de Land·zuri Yzarduy	España	1967-08-11
24	Agustin	Lara	México	1910-11-05
25	Santi	Balmes	España	1975-10-12
\.


--
-- Data for Name: disco_cancion; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.disco_cancion (disco_id, cancion_id) FROM stdin;
1	1
2	2
3	3
4	4
5	5
5	6
6	7
6	8
7	9
7	7
8	11
10	12
10	13
11	14
13	15
13	16
14	17
16	23
17	27
20	25
\.


--
-- Data for Name: discos; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.discos (disco_id, titulo, grupo_id, "año", genero, disquera_id, productor_id, costo, portada) FROM stdin;
2	Rocanlover	2	2003-02-02	Rock	2	2	1	img/00.png
3	Vida de perros	3	2004-03-03	Tradicional	3	3	11	img/00.png
4	Demotape	5	2004-04-04	Rock	4	4	10	img/00.png
5	Diamantes	6	2011-05-05	Rock	5	5	2	img/00.png
6	En electrico	7	2009-06-06	Synth-pop	1	2	4	img/00.png
7	Avalancha	8	1983-07-07	07/07/Rock	4	6	11	img/00.png
8	A Rush of Blood to the Head	9	2002-08-08	Pop-rock	6	7	12	img/00.png
9	Jeremy	10	1992-09-09	Grunge	7	8	11	img/00.png
10	Mucho	11	2008-10-10	Rock-alternativo	8	10	5	img/00.png
11	Pampas Reggae	12	1994-11-11	Reggae	8	11	8	img/00.png
12	Led Zeppelin III	16	1970-12-12	Hard Rock	12	19	20	img/00.png
13	Use Your Illusion I	14	1991-01-01	Hard Rock	14	17	6	img/00.png
14	Morrison Hotel	13	1970-02-02	Blues Rock	15	12	10	img/00.png
15	Aftermath	15	1966-03-03	Hard Rock	11	14	6	img/00.png
16	By The Way	22	2002-04-04	Rock Alternativo	2	16	7	img/00.png
17	Wish You Were Here	17	1975-05-05	Rock Progresivo	17	20	4	img/00.png
18	Please Please Me	18	1963-06-06	Rock N Roll	13	18	15	img/00.png
19	Pendulum	19	1970-07-07	Rock	10	21	10	img/00.png
20	Venus / Hot Sand	20	1969-08-08	Rock	18	15	7	img/00.png
21	The Who Sings My Generation	21	1965-09-09	Rock	16	13	5	img/00.png
1	Seguir Siendo	1	2011-01-01	Varios	1	1	5	img/00.png
\.


--
-- Data for Name: disqueras; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.disqueras (disquera_id, nombre, pais) FROM stdin;
1	Sony	Mexico
2	Warner Music	Estados Unidos
3	Big Sur records	Chile
4	Emi	Estados Unidos
5	Astro discos	España
6	Emi	Inglaterra
7	Sony Music	Estados Unidos
8	Universal Music	Argentina
9	Big Sur records	Chile
10	Fantasy Records	Estados Unidos
11	Decca Records	Inglaterra
12	Atlantic Records.	Estados Unidos
13	Parlophonev	Inglaterra
14	Geffen Records	Estados Unidos
15	Elektra Records	Estados Unidos
16	Brunswick	Inglaterra
17	Harvest Records	Inglaterra
18	Polydor Records	Inglaterra
\.


--
-- Data for Name: grupo_artista; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.grupo_artista (artista_id, grupo_id) FROM stdin;
1	1
2	2
3	3
4	1
5	6
6	7
7	8
8	9
11	11
12	12
13	13
32	22
33	22
14	14
31	13
15	14
16	16
17	16
21	15
23	18
28	18
29	18
\.


--
-- Data for Name: grupos; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.grupos (grupo_id, nombre, pais_origen) FROM stdin;
1	Cafe Tacuba	México
2	Zoe	México
3	Los Bunkers	Chile
4	Los Amis Invisibles	Venezuela
5	Los Abandoned	Estados Unidos
6	Columpio asesino	España
7	Moenia	México
8	Heroes del silencio	España
9	Coldplay	Inglaterra
10	Pearl jam	Estados Unidos
11	Babasonicos	Argentina
12	Los pericos	Argentina
13	The Doors	Estados Unidos
14	Guns N Roses	Estados Unidos
15	The Rolling Stones	Inglaterra
16	Led Zeppelin 	Inglaterra
17	Pink Floyd	Inglaterra
18	The Beatles	Inglaterra
19	Creedence Clearwater Revival 	Estados Unidos
20	Shocking Blue	PaÌses Bajos
21	Hoppo	México
22	Love of Lesbian	España
\.


--
-- Data for Name: productores; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.productores (productor_id, nombre, apellido, fecha_nacimiento) FROM stdin;
1	Gustavo	Santoalla	1947-10-01
2	Phil	Vinalli	1957-12-01
3	Mauricio	Melo	1987-10-11
4	David	Trumfio	1963-08-01
5	Keina	Garcia	1972-11-01
6	Bob	Ezrin	1991-12-02
7	Kenn	Nelson	1960-10-05
8	Rick	Parashar	1975-05-02
9	Ximena	Sariñana	1988-11-01
10	Eduardo	Rocca	1969-02-10
11	Gaston	Peñero	1976-06-01
12	Paul	Rothchild	1985-07-02
13	Shel	Talmy	1976-09-03
14	Andrew Loog	Oldham	1955-03-07
15	Robbie van	Leeuwen	1976-05-02
16	Rick	Rubin	1981-06-03
17	Mike	Clink	1990-11-09
18	George	 Martin	1978-10-02
19	James Patrick	Page	1980-01-04
20	Roger Keith 	Barrett	1983-05-12
21	John Cameron	Fogerty	1977-12-01
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: discos_dbo
--

COPY public.usuario (id, nombre, apaterno, amaterno, correo, telefono, usuario, contrasena) FROM stdin;
1	ivan	tronco	gamboa	\N	\N	ivantg47	\\xb221d9dbb083a7f33428d7c2a3c3198ae925614d70210e28716ccaa7cd4ddb79
\.


--
-- Name: artistas_artista_id_seq; Type: SEQUENCE SET; Schema: public; Owner: discos_dbo
--

SELECT pg_catalog.setval('public.artistas_artista_id_seq', 33, true);


--
-- Name: canciones_cancion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: discos_dbo
--

SELECT pg_catalog.setval('public.canciones_cancion_id_seq', 33, true);


--
-- Name: compositores_compositor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: discos_dbo
--

SELECT pg_catalog.setval('public.compositores_compositor_id_seq', 25, true);


--
-- Name: discos_disco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: discos_dbo
--

SELECT pg_catalog.setval('public.discos_disco_id_seq', 21, true);


--
-- Name: disqueras_disquera_id_seq; Type: SEQUENCE SET; Schema: public; Owner: discos_dbo
--

SELECT pg_catalog.setval('public.disqueras_disquera_id_seq', 18, true);


--
-- Name: grupos_grupo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: discos_dbo
--

SELECT pg_catalog.setval('public.grupos_grupo_id_seq', 22, true);


--
-- Name: productores_productor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: discos_dbo
--

SELECT pg_catalog.setval('public.productores_productor_id_seq', 21, true);


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: discos_dbo
--

SELECT pg_catalog.setval('public.usuario_id_seq', 1, true);


--
-- Name: artistas artistas_pkey; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.artistas
    ADD CONSTRAINT artistas_pkey PRIMARY KEY (artista_id);


--
-- Name: canciones canciones_pkey; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.canciones
    ADD CONSTRAINT canciones_pkey PRIMARY KEY (cancion_id);


--
-- Name: compositores compositores_pkey; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.compositores
    ADD CONSTRAINT compositores_pkey PRIMARY KEY (compositor_id);


--
-- Name: discos discos_pkey; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.discos
    ADD CONSTRAINT discos_pkey PRIMARY KEY (disco_id);


--
-- Name: disqueras disqueras_pkey; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.disqueras
    ADD CONSTRAINT disqueras_pkey PRIMARY KEY (disquera_id);


--
-- Name: grupos grupos_pkey; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.grupos
    ADD CONSTRAINT grupos_pkey PRIMARY KEY (grupo_id);


--
-- Name: grupo_artista pkag; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.grupo_artista
    ADD CONSTRAINT pkag PRIMARY KEY (artista_id, grupo_id);


--
-- Name: cancion_compositor pkcc; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.cancion_compositor
    ADD CONSTRAINT pkcc PRIMARY KEY (cancion_id, compositor_id);


--
-- Name: disco_cancion pkdc; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.disco_cancion
    ADD CONSTRAINT pkdc PRIMARY KEY (disco_id, cancion_id);


--
-- Name: productores productores_pkey; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.productores
    ADD CONSTRAINT productores_pkey PRIMARY KEY (productor_id);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: cancion_compositor cancion_compositor_cancion_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.cancion_compositor
    ADD CONSTRAINT cancion_compositor_cancion_id_fkey FOREIGN KEY (cancion_id) REFERENCES public.canciones(cancion_id);


--
-- Name: cancion_compositor cancion_compositor_compositor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.cancion_compositor
    ADD CONSTRAINT cancion_compositor_compositor_id_fkey FOREIGN KEY (compositor_id) REFERENCES public.compositores(compositor_id);


--
-- Name: disco_cancion disco_cancion_cancion_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.disco_cancion
    ADD CONSTRAINT disco_cancion_cancion_id_fkey FOREIGN KEY (cancion_id) REFERENCES public.canciones(cancion_id);


--
-- Name: disco_cancion disco_cancion_disco_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.disco_cancion
    ADD CONSTRAINT disco_cancion_disco_id_fkey FOREIGN KEY (disco_id) REFERENCES public.discos(disco_id);


--
-- Name: discos discos_disquera_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.discos
    ADD CONSTRAINT discos_disquera_id_fkey FOREIGN KEY (disquera_id) REFERENCES public.disqueras(disquera_id);


--
-- Name: discos discos_grupo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.discos
    ADD CONSTRAINT discos_grupo_id_fkey FOREIGN KEY (grupo_id) REFERENCES public.grupos(grupo_id);


--
-- Name: discos discos_productor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.discos
    ADD CONSTRAINT discos_productor_id_fkey FOREIGN KEY (productor_id) REFERENCES public.productores(productor_id);


--
-- Name: grupo_artista grupo_artista_artista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.grupo_artista
    ADD CONSTRAINT grupo_artista_artista_id_fkey FOREIGN KEY (artista_id) REFERENCES public.artistas(artista_id);


--
-- Name: grupo_artista grupo_artista_grupo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: discos_dbo
--

ALTER TABLE ONLY public.grupo_artista
    ADD CONSTRAINT grupo_artista_grupo_id_fkey FOREIGN KEY (grupo_id) REFERENCES public.grupos(grupo_id);


--
-- Name: TABLE artistas; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.artistas TO discos_oper;
GRANT SELECT ON TABLE public.artistas TO discos_reader;


--
-- Name: TABLE cancion_compositor; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.cancion_compositor TO discos_oper;
GRANT SELECT ON TABLE public.cancion_compositor TO discos_reader;


--
-- Name: TABLE canciones; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.canciones TO discos_oper;
GRANT SELECT ON TABLE public.canciones TO discos_reader;


--
-- Name: TABLE compositores; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.compositores TO discos_oper;
GRANT SELECT ON TABLE public.compositores TO discos_reader;


--
-- Name: TABLE disco_cancion; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.disco_cancion TO discos_oper;
GRANT SELECT ON TABLE public.disco_cancion TO discos_reader;


--
-- Name: TABLE discos; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.discos TO discos_oper;
GRANT SELECT ON TABLE public.discos TO discos_reader;


--
-- Name: TABLE grupos; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.grupos TO discos_oper;
GRANT SELECT ON TABLE public.grupos TO discos_reader;


--
-- Name: TABLE catalogo_cancion; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT ON TABLE public.catalogo_cancion TO discos_oper;


--
-- Name: TABLE disqueras; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.disqueras TO discos_oper;
GRANT SELECT ON TABLE public.disqueras TO discos_reader;


--
-- Name: TABLE grupo_artista; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.grupo_artista TO discos_oper;
GRANT SELECT ON TABLE public.grupo_artista TO discos_reader;


--
-- Name: TABLE productores; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.productores TO discos_oper;
GRANT SELECT ON TABLE public.productores TO discos_reader;


--
-- Name: TABLE usuario; Type: ACL; Schema: public; Owner: discos_dbo
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.usuario TO discos_oper;
GRANT SELECT ON TABLE public.usuario TO discos_reader;


--
-- PostgreSQL database dump complete
--

