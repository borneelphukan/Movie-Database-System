PGDMP         -                z           database    14.1    14.1 e    r           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            s           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            t           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            u           1262    16600    database    DATABASE     f   CREATE DATABASE database WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_Germany.1252';
    DROP DATABASE database;
                postgres    false                        3079    16740    fuzzystrmatch 	   EXTENSION     A   CREATE EXTENSION IF NOT EXISTS fuzzystrmatch WITH SCHEMA public;
    DROP EXTENSION fuzzystrmatch;
                   false            v           0    0    EXTENSION fuzzystrmatch    COMMENT     ]   COMMENT ON EXTENSION fuzzystrmatch IS 'determine similarities and distance between strings';
                        false    2            �            1259    16616    country    TABLE     m   CREATE TABLE public.country (
    id_country integer NOT NULL,
    country character varying(50) NOT NULL
);
    DROP TABLE public.country;
       public         heap    postgres    false            �            1259    16615    country_id_country_seq    SEQUENCE     �   CREATE SEQUENCE public.country_id_country_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.country_id_country_seq;
       public          postgres    false    215            w           0    0    country_id_country_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.country_id_country_seq OWNED BY public.country.id_country;
          public          postgres    false    214            �            1259    16609    genre    TABLE     g   CREATE TABLE public.genre (
    id_genre integer NOT NULL,
    genre character varying(50) NOT NULL
);
    DROP TABLE public.genre;
       public         heap    postgres    false            �            1259    16608    genre_id_genre_seq    SEQUENCE     �   CREATE SEQUENCE public.genre_id_genre_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.genre_id_genre_seq;
       public          postgres    false    213            x           0    0    genre_id_genre_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.genre_id_genre_seq OWNED BY public.genre.id_genre;
          public          postgres    false    212            �            1259    16630    keywords    TABLE     p   CREATE TABLE public.keywords (
    id_keywords integer NOT NULL,
    keywords character varying(50) NOT NULL
);
    DROP TABLE public.keywords;
       public         heap    postgres    false            �            1259    16629    keywords_id_keywords_seq    SEQUENCE     �   CREATE SEQUENCE public.keywords_id_keywords_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.keywords_id_keywords_seq;
       public          postgres    false    219            y           0    0    keywords_id_keywords_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.keywords_id_keywords_seq OWNED BY public.keywords.id_keywords;
          public          postgres    false    218            �            1259    16623    language    TABLE     p   CREATE TABLE public.language (
    id_language integer NOT NULL,
    language character varying(50) NOT NULL
);
    DROP TABLE public.language;
       public         heap    postgres    false            �            1259    16622    language_id_language_seq    SEQUENCE     �   CREATE SEQUENCE public.language_id_language_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.language_id_language_seq;
       public          postgres    false    217            z           0    0    language_id_language_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.language_id_language_seq OWNED BY public.language.id_language;
          public          postgres    false    216            �            1259    16651    movie    TABLE     �   CREATE TABLE public.movie (
    id_movie integer NOT NULL,
    title character varying(50) NOT NULL,
    min_age integer,
    id_rating integer,
    release_date integer,
    id_language integer,
    id_country integer
);
    DROP TABLE public.movie;
       public         heap    postgres    false            �            1259    16724    movie_genre    TABLE     l   CREATE TABLE public.movie_genre (
    id_mg integer NOT NULL,
    id_movie integer,
    id_genre integer
);
    DROP TABLE public.movie_genre;
       public         heap    postgres    false            �            1259    16723    movie_genre_id_mg_seq    SEQUENCE     �   CREATE SEQUENCE public.movie_genre_id_mg_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.movie_genre_id_mg_seq;
       public          postgres    false    233            {           0    0    movie_genre_id_mg_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.movie_genre_id_mg_seq OWNED BY public.movie_genre.id_mg;
          public          postgres    false    232            �            1259    16650    movie_id_movie_seq    SEQUENCE     �   CREATE SEQUENCE public.movie_id_movie_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.movie_id_movie_seq;
       public          postgres    false    225            |           0    0    movie_id_movie_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.movie_id_movie_seq OWNED BY public.movie.id_movie;
          public          postgres    false    224            �            1259    16673    movie_kw    TABLE     n   CREATE TABLE public.movie_kw (
    id_m_kw integer NOT NULL,
    id_movie integer,
    id_keywords integer
);
    DROP TABLE public.movie_kw;
       public         heap    postgres    false            �            1259    16672    movie_kw_id_m_kw_seq    SEQUENCE     �   CREATE SEQUENCE public.movie_kw_id_m_kw_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.movie_kw_id_m_kw_seq;
       public          postgres    false    227            }           0    0    movie_kw_id_m_kw_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.movie_kw_id_m_kw_seq OWNED BY public.movie_kw.id_m_kw;
          public          postgres    false    226            �            1259    16707    movie_related_person    TABLE     �   CREATE TABLE public.movie_related_person (
    id_m_rp integer NOT NULL,
    id_movie integer,
    id_related_person integer
);
 (   DROP TABLE public.movie_related_person;
       public         heap    postgres    false            �            1259    16706     movie_related_person_id_m_rp_seq    SEQUENCE     �   CREATE SEQUENCE public.movie_related_person_id_m_rp_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.movie_related_person_id_m_rp_seq;
       public          postgres    false    231            ~           0    0     movie_related_person_id_m_rp_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.movie_related_person_id_m_rp_seq OWNED BY public.movie_related_person.id_m_rp;
          public          postgres    false    230            �            1259    16637    person    TABLE     �   CREATE TABLE public.person (
    id_person integer NOT NULL,
    person_name character varying(50) NOT NULL,
    dob timestamp without time zone,
    gender character varying(10)
);
    DROP TABLE public.person;
       public         heap    postgres    false            �            1259    16636    person_id_person_seq    SEQUENCE     �   CREATE SEQUENCE public.person_id_person_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.person_id_person_seq;
       public          postgres    false    221                       0    0    person_id_person_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.person_id_person_seq OWNED BY public.person.id_person;
          public          postgres    false    220            �            1259    16602    rating    TABLE     S   CREATE TABLE public.rating (
    id_rating integer NOT NULL,
    rating integer
);
    DROP TABLE public.rating;
       public         heap    postgres    false            �            1259    16601    rating_id_rating_seq    SEQUENCE     �   CREATE SEQUENCE public.rating_id_rating_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.rating_id_rating_seq;
       public          postgres    false    211            �           0    0    rating_id_rating_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.rating_id_rating_seq OWNED BY public.rating.id_rating;
          public          postgres    false    210            �            1259    16690    related_person    TABLE     {   CREATE TABLE public.related_person (
    id_related_person integer NOT NULL,
    id_person integer,
    id_role integer
);
 "   DROP TABLE public.related_person;
       public         heap    postgres    false            �            1259    16689 $   related_person_id_related_person_seq    SEQUENCE     �   CREATE SEQUENCE public.related_person_id_related_person_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.related_person_id_related_person_seq;
       public          postgres    false    229            �           0    0 $   related_person_id_related_person_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.related_person_id_related_person_seq OWNED BY public.related_person.id_related_person;
          public          postgres    false    228            �            1259    16644    roles    TABLE     j   CREATE TABLE public.roles (
    id_role integer NOT NULL,
    role_name character varying(50) NOT NULL
);
    DROP TABLE public.roles;
       public         heap    postgres    false            �            1259    16643    roles_id_role_seq    SEQUENCE     �   CREATE SEQUENCE public.roles_id_role_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.roles_id_role_seq;
       public          postgres    false    223            �           0    0    roles_id_role_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.roles_id_role_seq OWNED BY public.roles.id_role;
          public          postgres    false    222            �           2604    16619    country id_country    DEFAULT     x   ALTER TABLE ONLY public.country ALTER COLUMN id_country SET DEFAULT nextval('public.country_id_country_seq'::regclass);
 A   ALTER TABLE public.country ALTER COLUMN id_country DROP DEFAULT;
       public          postgres    false    215    214    215            �           2604    16612    genre id_genre    DEFAULT     p   ALTER TABLE ONLY public.genre ALTER COLUMN id_genre SET DEFAULT nextval('public.genre_id_genre_seq'::regclass);
 =   ALTER TABLE public.genre ALTER COLUMN id_genre DROP DEFAULT;
       public          postgres    false    213    212    213            �           2604    16633    keywords id_keywords    DEFAULT     |   ALTER TABLE ONLY public.keywords ALTER COLUMN id_keywords SET DEFAULT nextval('public.keywords_id_keywords_seq'::regclass);
 C   ALTER TABLE public.keywords ALTER COLUMN id_keywords DROP DEFAULT;
       public          postgres    false    218    219    219            �           2604    16626    language id_language    DEFAULT     |   ALTER TABLE ONLY public.language ALTER COLUMN id_language SET DEFAULT nextval('public.language_id_language_seq'::regclass);
 C   ALTER TABLE public.language ALTER COLUMN id_language DROP DEFAULT;
       public          postgres    false    217    216    217            �           2604    16654    movie id_movie    DEFAULT     p   ALTER TABLE ONLY public.movie ALTER COLUMN id_movie SET DEFAULT nextval('public.movie_id_movie_seq'::regclass);
 =   ALTER TABLE public.movie ALTER COLUMN id_movie DROP DEFAULT;
       public          postgres    false    224    225    225            �           2604    16727    movie_genre id_mg    DEFAULT     v   ALTER TABLE ONLY public.movie_genre ALTER COLUMN id_mg SET DEFAULT nextval('public.movie_genre_id_mg_seq'::regclass);
 @   ALTER TABLE public.movie_genre ALTER COLUMN id_mg DROP DEFAULT;
       public          postgres    false    232    233    233            �           2604    16676    movie_kw id_m_kw    DEFAULT     t   ALTER TABLE ONLY public.movie_kw ALTER COLUMN id_m_kw SET DEFAULT nextval('public.movie_kw_id_m_kw_seq'::regclass);
 ?   ALTER TABLE public.movie_kw ALTER COLUMN id_m_kw DROP DEFAULT;
       public          postgres    false    227    226    227            �           2604    16710    movie_related_person id_m_rp    DEFAULT     �   ALTER TABLE ONLY public.movie_related_person ALTER COLUMN id_m_rp SET DEFAULT nextval('public.movie_related_person_id_m_rp_seq'::regclass);
 K   ALTER TABLE public.movie_related_person ALTER COLUMN id_m_rp DROP DEFAULT;
       public          postgres    false    231    230    231            �           2604    16640    person id_person    DEFAULT     t   ALTER TABLE ONLY public.person ALTER COLUMN id_person SET DEFAULT nextval('public.person_id_person_seq'::regclass);
 ?   ALTER TABLE public.person ALTER COLUMN id_person DROP DEFAULT;
       public          postgres    false    220    221    221            �           2604    16605    rating id_rating    DEFAULT     t   ALTER TABLE ONLY public.rating ALTER COLUMN id_rating SET DEFAULT nextval('public.rating_id_rating_seq'::regclass);
 ?   ALTER TABLE public.rating ALTER COLUMN id_rating DROP DEFAULT;
       public          postgres    false    211    210    211            �           2604    16693     related_person id_related_person    DEFAULT     �   ALTER TABLE ONLY public.related_person ALTER COLUMN id_related_person SET DEFAULT nextval('public.related_person_id_related_person_seq'::regclass);
 O   ALTER TABLE public.related_person ALTER COLUMN id_related_person DROP DEFAULT;
       public          postgres    false    228    229    229            �           2604    16647    roles id_role    DEFAULT     n   ALTER TABLE ONLY public.roles ALTER COLUMN id_role SET DEFAULT nextval('public.roles_id_role_seq'::regclass);
 <   ALTER TABLE public.roles ALTER COLUMN id_role DROP DEFAULT;
       public          postgres    false    222    223    223            ]          0    16616    country 
   TABLE DATA           6   COPY public.country (id_country, country) FROM stdin;
    public          postgres    false    215   �q       [          0    16609    genre 
   TABLE DATA           0   COPY public.genre (id_genre, genre) FROM stdin;
    public          postgres    false    213   r       a          0    16630    keywords 
   TABLE DATA           9   COPY public.keywords (id_keywords, keywords) FROM stdin;
    public          postgres    false    219   (r       _          0    16623    language 
   TABLE DATA           9   COPY public.language (id_language, language) FROM stdin;
    public          postgres    false    217   Er       g          0    16651    movie 
   TABLE DATA           k   COPY public.movie (id_movie, title, min_age, id_rating, release_date, id_language, id_country) FROM stdin;
    public          postgres    false    225   br       o          0    16724    movie_genre 
   TABLE DATA           @   COPY public.movie_genre (id_mg, id_movie, id_genre) FROM stdin;
    public          postgres    false    233   r       i          0    16673    movie_kw 
   TABLE DATA           B   COPY public.movie_kw (id_m_kw, id_movie, id_keywords) FROM stdin;
    public          postgres    false    227   �r       m          0    16707    movie_related_person 
   TABLE DATA           T   COPY public.movie_related_person (id_m_rp, id_movie, id_related_person) FROM stdin;
    public          postgres    false    231   �r       c          0    16637    person 
   TABLE DATA           E   COPY public.person (id_person, person_name, dob, gender) FROM stdin;
    public          postgres    false    221   �r       Y          0    16602    rating 
   TABLE DATA           3   COPY public.rating (id_rating, rating) FROM stdin;
    public          postgres    false    211   �r       k          0    16690    related_person 
   TABLE DATA           O   COPY public.related_person (id_related_person, id_person, id_role) FROM stdin;
    public          postgres    false    229   s       e          0    16644    roles 
   TABLE DATA           3   COPY public.roles (id_role, role_name) FROM stdin;
    public          postgres    false    223   -s       �           0    0    country_id_country_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.country_id_country_seq', 1, false);
          public          postgres    false    214            �           0    0    genre_id_genre_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.genre_id_genre_seq', 1, false);
          public          postgres    false    212            �           0    0    keywords_id_keywords_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.keywords_id_keywords_seq', 1, false);
          public          postgres    false    218            �           0    0    language_id_language_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.language_id_language_seq', 1, false);
          public          postgres    false    216            �           0    0    movie_genre_id_mg_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.movie_genre_id_mg_seq', 6, true);
          public          postgres    false    232            �           0    0    movie_id_movie_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.movie_id_movie_seq', 3, true);
          public          postgres    false    224            �           0    0    movie_kw_id_m_kw_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.movie_kw_id_m_kw_seq', 7, true);
          public          postgres    false    226            �           0    0     movie_related_person_id_m_rp_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.movie_related_person_id_m_rp_seq', 1, false);
          public          postgres    false    230            �           0    0    person_id_person_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.person_id_person_seq', 1, false);
          public          postgres    false    220            �           0    0    rating_id_rating_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.rating_id_rating_seq', 1, false);
          public          postgres    false    210            �           0    0 $   related_person_id_related_person_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.related_person_id_related_person_seq', 1, false);
          public          postgres    false    228            �           0    0    roles_id_role_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.roles_id_role_seq', 1, false);
          public          postgres    false    222            �           2606    16621    country country_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.country
    ADD CONSTRAINT country_pkey PRIMARY KEY (id_country);
 >   ALTER TABLE ONLY public.country DROP CONSTRAINT country_pkey;
       public            postgres    false    215            �           2606    16614    genre genre_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.genre
    ADD CONSTRAINT genre_pkey PRIMARY KEY (id_genre);
 :   ALTER TABLE ONLY public.genre DROP CONSTRAINT genre_pkey;
       public            postgres    false    213            �           2606    16635    keywords keywords_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.keywords
    ADD CONSTRAINT keywords_pkey PRIMARY KEY (id_keywords);
 @   ALTER TABLE ONLY public.keywords DROP CONSTRAINT keywords_pkey;
       public            postgres    false    219            �           2606    16628    language language_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.language
    ADD CONSTRAINT language_pkey PRIMARY KEY (id_language);
 @   ALTER TABLE ONLY public.language DROP CONSTRAINT language_pkey;
       public            postgres    false    217            �           2606    16729    movie_genre movie_genre_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.movie_genre
    ADD CONSTRAINT movie_genre_pkey PRIMARY KEY (id_mg);
 F   ALTER TABLE ONLY public.movie_genre DROP CONSTRAINT movie_genre_pkey;
       public            postgres    false    233            �           2606    16678    movie_kw movie_kw_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.movie_kw
    ADD CONSTRAINT movie_kw_pkey PRIMARY KEY (id_m_kw);
 @   ALTER TABLE ONLY public.movie_kw DROP CONSTRAINT movie_kw_pkey;
       public            postgres    false    227            �           2606    16656    movie movie_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.movie
    ADD CONSTRAINT movie_pkey PRIMARY KEY (id_movie);
 :   ALTER TABLE ONLY public.movie DROP CONSTRAINT movie_pkey;
       public            postgres    false    225            �           2606    16712 .   movie_related_person movie_related_person_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.movie_related_person
    ADD CONSTRAINT movie_related_person_pkey PRIMARY KEY (id_m_rp);
 X   ALTER TABLE ONLY public.movie_related_person DROP CONSTRAINT movie_related_person_pkey;
       public            postgres    false    231            �           2606    16642    person person_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_pkey PRIMARY KEY (id_person);
 <   ALTER TABLE ONLY public.person DROP CONSTRAINT person_pkey;
       public            postgres    false    221            �           2606    16607    rating rating_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.rating
    ADD CONSTRAINT rating_pkey PRIMARY KEY (id_rating);
 <   ALTER TABLE ONLY public.rating DROP CONSTRAINT rating_pkey;
       public            postgres    false    211            �           2606    16695 "   related_person related_person_pkey 
   CONSTRAINT     o   ALTER TABLE ONLY public.related_person
    ADD CONSTRAINT related_person_pkey PRIMARY KEY (id_related_person);
 L   ALTER TABLE ONLY public.related_person DROP CONSTRAINT related_person_pkey;
       public            postgres    false    229            �           2606    16649    roles roles_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id_role);
 :   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_pkey;
       public            postgres    false    223            �           2606    16667    movie fk_id_country    FK CONSTRAINT     �   ALTER TABLE ONLY public.movie
    ADD CONSTRAINT fk_id_country FOREIGN KEY (id_country) REFERENCES public.country(id_country) ON DELETE CASCADE;
 =   ALTER TABLE ONLY public.movie DROP CONSTRAINT fk_id_country;
       public          postgres    false    3247    225    215            �           2606    16662    movie fk_id_language    FK CONSTRAINT     �   ALTER TABLE ONLY public.movie
    ADD CONSTRAINT fk_id_language FOREIGN KEY (id_language) REFERENCES public.language(id_language) ON DELETE CASCADE;
 >   ALTER TABLE ONLY public.movie DROP CONSTRAINT fk_id_language;
       public          postgres    false    217    3249    225            �           2606    16657    movie fk_id_rating    FK CONSTRAINT     �   ALTER TABLE ONLY public.movie
    ADD CONSTRAINT fk_id_rating FOREIGN KEY (id_rating) REFERENCES public.rating(id_rating) ON DELETE CASCADE;
 <   ALTER TABLE ONLY public.movie DROP CONSTRAINT fk_id_rating;
       public          postgres    false    211    3243    225            �           2606    16730    movie_genre fk_mg_genre    FK CONSTRAINT     }   ALTER TABLE ONLY public.movie_genre
    ADD CONSTRAINT fk_mg_genre FOREIGN KEY (id_genre) REFERENCES public.genre(id_genre);
 A   ALTER TABLE ONLY public.movie_genre DROP CONSTRAINT fk_mg_genre;
       public          postgres    false    213    233    3245            �           2606    16735    movie_genre fk_mg_movie    FK CONSTRAINT     �   ALTER TABLE ONLY public.movie_genre
    ADD CONSTRAINT fk_mg_movie FOREIGN KEY (id_movie) REFERENCES public.movie(id_movie) ON DELETE CASCADE;
 A   ALTER TABLE ONLY public.movie_genre DROP CONSTRAINT fk_mg_movie;
       public          postgres    false    233    3257    225            �           2606    16679    movie_kw fk_mkw_keywords    FK CONSTRAINT     �   ALTER TABLE ONLY public.movie_kw
    ADD CONSTRAINT fk_mkw_keywords FOREIGN KEY (id_keywords) REFERENCES public.keywords(id_keywords);
 B   ALTER TABLE ONLY public.movie_kw DROP CONSTRAINT fk_mkw_keywords;
       public          postgres    false    3251    219    227            �           2606    16684    movie_kw fk_mkw_movie    FK CONSTRAINT     �   ALTER TABLE ONLY public.movie_kw
    ADD CONSTRAINT fk_mkw_movie FOREIGN KEY (id_movie) REFERENCES public.movie(id_movie) ON DELETE CASCADE;
 ?   ALTER TABLE ONLY public.movie_kw DROP CONSTRAINT fk_mkw_movie;
       public          postgres    false    3257    227    225            �           2606    16718 !   movie_related_person fk_mrp_movie    FK CONSTRAINT     �   ALTER TABLE ONLY public.movie_related_person
    ADD CONSTRAINT fk_mrp_movie FOREIGN KEY (id_movie) REFERENCES public.movie(id_movie) ON DELETE CASCADE;
 K   ALTER TABLE ONLY public.movie_related_person DROP CONSTRAINT fk_mrp_movie;
       public          postgres    false    225    231    3257            �           2606    16713    movie_related_person fk_mrp_rp    FK CONSTRAINT     �   ALTER TABLE ONLY public.movie_related_person
    ADD CONSTRAINT fk_mrp_rp FOREIGN KEY (id_related_person) REFERENCES public.related_person(id_related_person) ON DELETE CASCADE;
 H   ALTER TABLE ONLY public.movie_related_person DROP CONSTRAINT fk_mrp_rp;
       public          postgres    false    229    3261    231            �           2606    16696    related_person fk_rp_person    FK CONSTRAINT     �   ALTER TABLE ONLY public.related_person
    ADD CONSTRAINT fk_rp_person FOREIGN KEY (id_person) REFERENCES public.person(id_person) ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.related_person DROP CONSTRAINT fk_rp_person;
       public          postgres    false    221    3253    229            �           2606    16701    related_person fk_rp_role    FK CONSTRAINT     }   ALTER TABLE ONLY public.related_person
    ADD CONSTRAINT fk_rp_role FOREIGN KEY (id_role) REFERENCES public.roles(id_role);
 C   ALTER TABLE ONLY public.related_person DROP CONSTRAINT fk_rp_role;
       public          postgres    false    229    223    3255            ]      x������ � �      [      x������ � �      a      x������ � �      _      x������ � �      g      x������ � �      o      x������ � �      i      x������ � �      m      x������ � �      c      x������ � �      Y      x������ � �      k      x������ � �      e      x������ � �     