/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: php_mvc_app
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(32) NOT NULL,
  `number_of_pages` int(11) NOT NULL,
  `date_of_publication` date NOT NULL,
  `summary` text NOT NULL,
  `media_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `books_isbn_unique` (`isbn`),
  KEY `books_media_id_index` (`media_id`),
  CONSTRAINT `books_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `medias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES
(3,'Yuval Noah Harari','9782226436038',512,'2015-09-10','De la révolution cognitive à l’ère des algorithmes, Harari retrace comment des fictions partagées — religions, États, monnaies — ont permis à des millions d’humains de coopérer, au prix d’immenses bouleversements écologiques et sociaux.',3),
(4,'Antoine de Saint-Exupéry','9780156013987',96,'2015-01-01','Le voyage poétique d’un petit prince à travers les planètes révèle l’absurdité des grandes personnes et la valeur de l’amitié. Un conte philosophique sur l’enfance, l’émerveillement et ce qui se voit avec le cœur.',4),
(5,'Albert Camus','9782070360024',192,'2012-03-15','Meursault, étranger à lui-même et au monde, commet un acte irréparable sous un soleil écrasant. Récit limpide et dérangeant sur l’absurde, la culpabilité et la liberté d’un homme face au jugement.',5),
(7,'Isaac Asimov','9780553293357',296,'2018-02-11','La psychohistoire prédit la chute de l’Empire. Des savants fondent Fondation pour préserver le savoir et raccourcir les âges sombres, entre intrigues politiques, crises économiques et audaces scientifiques.',7),
(8,'Albert Camus','9782070360420',320,'2011-10-10','À Oran, la peste s’abat sans prévenir. Médecins et habitants luttent contre l’épidémie et l’indifférence. Une allégorie puissante de la solidarité, du mal et de la dignité humaine.',8),
(9,'Victor Hugo','9782253004226',1488,'2010-09-01','De Jean Valjean à Javert, destins brisés et rédemption se croisent dans la France du XIXe siècle. Un roman monumental sur la misère, la justice, l’amour et l’espérance.',9),
(10,'J. K. Rowling','9780747532699',320,'2007-09-01','Un orphelin découvre qu’il est sorcier et entre à Poudlard. Amitiés, mystères et premières épreuves tissent le début d’une saga initiatique et enchanteresse.',10),
(11,'J. K. Rowling','9780747538493',352,'2008-09-01','Une chambre mythique, un héritier menaçant et des secrets du passé mettent l’école en péril. Harry affronte peurs, préjugés et forces obscures.',11),
(12,'J. K. Rowling','9780747542155',448,'2009-09-01','Dementors, procès et énigmes temporelles : Harry mûrit dans un monde où le danger grandit et où la vérité se cache derrière les apparences.',12),
(13,'Umberto Eco','9780156001311',552,'2016-05-05','Dans une abbaye médiévale, un moine enquête sur des meurtres liés à une bibliothèque labyrinthique. Thriller érudit où sémiologie, théologie et pouvoir s’entremêlent.',13),
(14,'Dan Brown','9780385504201',592,'2013-04-20','Un cryptologue et une conservatrice percent un secret ancien au cœur de l’art et des symboles religieux. Une chasse au trésor contemporaine rythmée par les énigmes.',14),
(15,'Stephen King','9780307743657',688,'2014-10-31','Un hôtel isolé, un père fragile, un fils aux pouvoirs psychiques. La folie s’installe à mesure que l’hiver ferme toutes issues. Un classique d’horreur psychologique.',15),
(16,'Stephen King','9781501142970',1156,'2015-10-31','Une petite ville du Maine affronte une entité maléfique qui se nourrit des peurs. Un groupe d’amis, liés par un serment, défie l’horreur à deux époques.',16),
(17,'William Gibson','9780441569595',271,'2017-07-07','Cowboys du cyberespace, IA clandestines et mégacorpos : le roman fondateur du cyberpunk imagine un futur branché sur le réseau, où l’information est une drogue.',17),
(18,'J. R. R. Tolkien','9780618126989',365,'2005-03-02','Mythes fondateurs de la Terre du Milieu : création du monde, destins tragiques et éclat des Silmarils. Une cosmogonie poétique et sombre.',18),
(19,'Alain Damasio','9782070772896',700,'2011-11-11','Une horde affronte des vents titanesques pour atteindre l’Extrême-Amont. Langue inventive, polyphonie et souffle épique pour une odyssée unique.',19),
(20,'René Barjavel','9782266162052',352,'2010-12-12','Amour impossible et voyage vers un passé englouti : une civilisation polaire oubliée interroge le progrès et la mémoire du monde.',20),
(22,'Pierre Lemaitre','9782702183625',592,'2025-01-21','« Je viens sauver quelqu’un, se répétait-il, et maintenant qu’il se trouvait à deux heures de Prague, il sentait monter en lui une vive anxiété. »\r\nUne échappée belle de Paris à Prague, d’un studio de radio à des ruelles hostiles, d’un cachot glacé à une académie de billard, d’une école de bonnes sœurs aux bureaux obscurs de la République.\r\nChacun des Pelletier, à son heure, devra choisir entre son intérêt et son devoir, et pour certains entre la raison du cœur et la raison d’État.\r\nUn dilemme parfois déchirant, sauf pour le chat Joseph, qui lui a choisi depuis longtemps.',64),
(23,'Camille Laurens','9782072912238',368,'2025-01-02','«Au moment où s\'ouvre ce livre, je romps une promesse. Lorsque je l\'ai faite, c\'est idiot, j\'étais sûre que je la tiendrais. Enfin, idiot, je ne sais pas. La moindre des choses, quand on fait une promesse, n\'est-ce pas d\'y croire ?» Que s\'est-il passé avec son compagnon pour que la romancière Claire Lancel doive se défendre devant un tribunal ? Au fil du récit, elle raconte comment elle s\'est peu à peu laissé entraîner dans une histoire faite de manipulations et de mensonges. Dans ce roman haletant comme un thriller, Camille Laurens questionne le narcissisme contemporain, l\'absence d\'empathie, et se demande comment sauver l\'amour de ses illusions. Elle nous invite à le célébrer et à le vivre, au-delà des promesses trahies. ',71),
(24,'Maxime Chattam','9782266311281',672,'2025-02-06','Les scientifiques comme les religieux ne peuvent expliquer ce qu’elle est ni d’où elle vient.\r\nElle va transformer pour toujours le quotidien du monde entier, en particulier l’existence d’une mère et de sa fille.\r\nTout en posant la question qui nous obsède tous...\r\nNos vies ont-elles un sens ?\r\nUn roman au suspense saisissant, hommage lumineux à Barjavel et à la littérature qui divertit, qui interroge.\r\nMaxime Chattam comme vous ne l’avez jamais lu.',72),
(27,'SenLinYu','9782017293705',960,'2025-10-01','Alchemised de SenLinYu, qui se déroule dans un monde de nécromancie et d\'alchimie déchiré par la guerre, dans lequel une guérisseuse amnésique est faite prisonnière de guerre et doit se battre pour protéger ses souvenirs perdus et les secrets qui s\'y cachent.',86),
(28,'Asma Mhalla','9782021587593',328,'2025-09-19','En ce début de XXIe siècle, l’alliance chaotique de Donald Trump et d’Elon Musk a fait surgir une créature technopolitique à deux têtes. L’une orchestre le show, l’autre code le système. Quelque chose d’insaisissable est pourtant à l’œuvre.\r\n\r\nGourous de la Silicon Valley et idéologues néo-réactionnaires orchestrent un fascisme-simulacre annonciateur d’un bouleversement plus profond. Un nouveau régime, hybride, où l’État s’efface… pour mieux tout contrôler.\r\n\r\nL’emprise avance en silence, à l’échelle planétaire. Un empire cognitif reconfigure la démocratie, colonise les corps et les esprits. Depuis le laboratoire américain où s’expérimente le futur, ce livre décrypte le logiciel techno-totalitaire. Dans le monde qui vient, vous ne serez pas augmentés. Vous serez programmés.\r\n\r\nLe futur est déjà là. La dystopie cyberpunk n’est plus une fiction, c’est notre réalité. Comprendrons-nous à temps ce qui se joue ?\r\n\r\nAsma Mhalla signe un essai coup de poing pour nommer la nouvelle arène du pouvoir. Et défendre ce qu’il nous reste : notre liberté.\r\n\r\nAsma Mhalla est politologue et essayiste. Elle est l’autrice d’un premier livre remarqué, Technopolitique. Comment la technologie fait de nous des soldats (Seuil, 2024).',87),
(29,'J. R. R. Tolkien','2266232991',1400,'1955-01-01','Épopée fantasy où le jeune hobbit Frodon Sacquet hérite d\'un anneau magique qui s\'avère être l\'Anneau Unique, créé par le Seigneur des Ténèbres Sauron. Frodon doit entreprendre un périlleux voyage pour détruire l\'anneau en le jetant dans les flammes de la Montagne du Destin. Accompagné de la Communauté de l\'Anneau, il traverse la Terre du Milieu, confrontant diverses créatures et dangers. L\'œuvre traite de l\'amitié, du courage, de la corruption du pouvoir et du sacrifice.\r\n',93),
(30,' Freida McFadden',' 2824627158',400,'2025-10-08','Célibataire, Sydney n’a jamais eu vraiment de chance en amour. Jusqu’au jour où elle rencontre Tom. Il est charmant, séduisant, et médecin dans un hôpital. C’est l’homme idéal et Sydney est conquise.\r\n\r\nEt puis, un jour, le meurtre barbare d’une femme sème la terreur dans la ville. Ce n’est que le dernier crime d’une série déjà longue. Le profil du suspect ? Un homme mystérieux qui entretiendrait une relation avec ses victimes avant de les assassiner.\r\n\r\nAvec Tom à ses côtés, Sydney devrait se sentir en sécurité. Mais elle ne peut s’empêcher de trouver que quelque chose ne va pas, elle a le sentiment que cet homme parfait lui cache quelque chose... et puis, depuis quelque temps, elle se sent suivie et épiée. Sydney doit absolument découvrir au plus vite la vérité. Sinon...',94),
(31,' Franck Thilliez',' 1039562531',388,'2025-09-25','Naël découvre un carnet devant chez lui.\r\nLe carnet de Léo, kidnappé il y a un an, jour pour jour.\r\nDésormais, leurs destins sont liés.\r\nDésormais, Naël est coincé...',95),
(32,'Freida McFadden','9782290415634',448,'2025-10-08','Après avoir été au service des autres en tant que femme de ménage, Millie s\'est enfin construit une vie à elle. Elle vient même d\'emménager dans une belle maison, à l\'abri d\'une petite impasse chic et tranquille, avec son mari et ses deux enfants. Mais son rêve d\'une existence paisible se ternit rapidement lorsqu\'elle rencontre ses voisins. Il y a Suzette, bien trop snob et aguicheuse, et son insipide mari, Jonathan, sans oublier leur terrifiante femme de ménage au regard perçant et au comportement plus que suspect. Les craintes de Millie montent d\'un cran lorsque d\'étranges bruits se font entendre la nuit dans sa propre maison...',98),
(33,'Mélissa Da Costa','9782253251712',768,'2025-08-20','Jusqu\'où peut-on aimer ? Jusqu\'à s\'oublier...\r\nL\'histoire inoubliable d\'un couple qui doit faire face au handicap. ',99),
(34,'Gaël Faye','9782253252030',288,'2025-10-01','Quelques années après le génocide des Tutsi un jeune homme part à la découverte du Rwanda, le pays de sa mère.',100),
(35,'Virginie Grimaldi','9782253251675',312,'2025-05-07','Quand Elsa et Vincent se rencontrent dans la salle d\'attente de leur psychiatre, ils voient leur vie bouleversée.',101),
(36,'Philippe Boxho','9782253252559',256,'2025-08-27','Philippe Boxho, médecin légiste, fait parler les cadavres. Âmes sensibles s’abstenir !',102),
(37,'Thomas Schlesser','9782253907947',620,'2025-05-21','Le roman d\'initiation à la beauté du monde - par son grand-père - d\'une petite fille qui va devenir aveugle. ',103),
(38,'Viveca Sten','9782253254812',608,'2025-09-17','Une femme d\'affaires à l\'origine d\'un projet de complexe hôtelier de luxe près d’Åre est retrouvée poignardée.',104),
(39,'Lisa Gardner','9782253253402',576,'2025-08-20','Il ne faut pas moins des trois héroïnes fétiches de Lisa Gardner pour élucider l\'origine d\'un charnier dans les Appalaches,\r\navec pour seul témoin une adolescente muette...',105),
(40,'Gaël Faye','9782253070443',224,'2017-08-23','Avant, Gabriel faisait les quatre cents coups avec ses copains dans leur coin de paradis. Et puis l\'harmonie familiale s\'est disloquée en même temps que son «  petit pays  », le Burundi, ce bout d\'Afrique centrale brutalement malmené par l\'Histoire.\r\nPlus tard, Gabriel fait revivre un monde à jamais perdu. Les battements de cœur et les souffles coupés, les pensées profondes et les rires déployés, le parfum de citronnelle, les termites les jours d\'orage, les jacarandas en fleur... L\'enfance, son infinie douceur, ses douleurs...',106),
(41,'Bernard Werber','9782253909927',672,'2025-10-01','C’est une histoire d’amour qui a commencé il y a 120 000 ans.\r\n\r\nEugénie Toledano et son âme soeur se sont retrouvées vie après vie, mais à chaque fois les forces de l’obscurantisme les ont séparées.',107),
(42,'Michael Connelly','9782253254577',480,'2025-08-27','Harry Bosch s\'allie à Mickey Haller pour sauver une innocente accusée\r\ndu meurtre de son mari, un policier véreux.',108),
(43,'Syou Ishida','9782253256328',320,'2025-10-01','Au Japon, une clinique mystérieuse propose un traitement unique à ses patients :  elle prescrit des chats. ',109),
(44,'Fabienne Duvigneau','9782253262329',672,'2020-06-03','À la mort de leur père, énigmatique milliardaire qui les a adoptées aux quatre coins du monde lorsqu\'elles étaient bébés, Maia d\'Aplièse et ses soeurs se retrouvent dans la maison de leur enfance, Atlantis, un magnifique château sur les bords du lac de Genève. Pour héritage, elles reçoivent chacune un mystérieux indice qui leur permettra peut-être de percer le secret de leur origine.',110),
(45,'King (Bachman)','9782253151395',384,'2025-12-06','Mieux que le marathon... la Longue Marche. Cent concurrents au départ, un seul à l\'arrivée. Pour les autres, une balle dans la tête. Marche ou crève. Telle est la morale de cette compétition... sur laquelle une Amérique obscène et fière de ses combattants mise chaque année deux milliards de dollars.\r\nSur la route, le pire, ce n\'est pas la fatigue, la soif, ou même le bruit des half-tracks et l\'aboiement des fusils. Le pire c\'est cette créature sans tête, sans corps et sans esprit qu\'il faut affronter : la foule, qui harangue les concurrents dans un délire paroxystique de plus en plus violent. L\'aventure est formidablement inhumaine.\r\nLes participants continuent de courir en piétinant des corps morts, continuent de respirer malgré l\'odeur des cadavres, continuent de vouloir gagner en dépit de tout. Mais pour quelle victoire ?',111),
(46,'Donato Carrisi','9782253254553',544,'2025-10-01','DANS LE SILENCE DES CHUTES DE NEIGE, SEUL LE RUGISSEMENT DU FEU SE FAIT ENTENDRE. ET LORSQUE LA MAISON EN BOIS S’EFFONDRE, IL NE RESTE QUE LES MURMURES EFFRAYÉS DE CEUX QUI ONT RÉUSSI À S’ÉCHAPPER.\r\n \r\nGrâce à sa détermination et son sang-froid, Serena, une redoutable femme d’affaires, va de réussite en réussite. Elle vit de manière opulente à Milan sous le règne de l’ordre et du contrôle. Mais lorsqu’elle tombe accidentellement enceinte d’Aurora, Serena doit endosser une responsabilité qu’elle n’avait jamais imaginée : celle de mère.\r\n\r\nSix ans plus tard, dans une colonie de vacances nichée au cœur des montagnes suisses, un incendie ravageur menace la vie des douze petites pensionnaires. Pendant un instant, les équipes de secours croient avoir retrouvé toutes les enfants – mais il en manque une : Aurora. Aucune trace de son corps n’est trouvée dans les décombres.\r\n\r\nTandis que Serena cherche à faire son deuil, une personne anonyme la contacte et affirme que sa fille est toujours vivante. Pire encore, elle serait en danger… C’est alors que commence la plus grande mission de la vie de Serena : retrouver Aurora et la délivrer du mal.\r\n \r\nEST-CE QUE MÊME LA PLUS COURAGEUSE DES MÈRES EST CAPABLE DE TOUT ?',112),
(47,'Ken Follett','9782253071563',1120,'2025-01-02','Fin du xviiie  siècle. L’Angleterre est dirigée par un gouvernement répressif. De l’autre côté de la Manche, Napoléon Bonaparte accroît inexorablement son pouvoir. Alors que la guerre est aux portes de l’Europe, la vie des habitants de Kingsbridge est sur le point de basculer. Sal, fileuse téméraire, est témoin d’un accident tragique qui va bouleverser son existence. Amos, drapier, qui a hérité prématurément du négoce de son père, doit affronter le terrible Hornbeam pour rembourser ses dettes. Il est aidé de Spade, tisserand novateur, et encouragé par Elsie, qui se bat pour financer une école destinée aux enfants pauvres.\r\nEntre destins contrariés, jalousies meurtrières, justice arbitraire, guerre sanglante et révolution industrielle, Ken Follett dépeint avec une virtuosité inégalée une génération qui incarne la lutte pour la liberté.',113),
(48,'Linda Green','9782253105183',416,'2022-11-09','Sur son lit de mort, Nana fait une confidence étrange à sa petite-fille Nicola : elle lui demande de veiller sur ses bébés au fond du jardin…\r\nIrène, la mère de Nicola, soutient que la mourante avait certainement perdu la raison au moment de son dernier souffle, mais semble très perturbée par cette révélation. Elle somme même sa fille de se taire pour le bien de tous. Tandis que les proches pleurent la disparue, la petite Maisie, en jouant, fait une macabre découverte dans le jardin : un minuscule os… humain ? Voilà qui jette le trouble.\r\nPour Nicola commence alors une enquête difficile et éprouvante sur sa propre famille.\r\nGrâce à des personnages parfaitement campés et à une intrigue implacable, Linda Green prouve une nouvelle fois avec ce roman son talent pour embarquer durablement le lecteur.',114),
(49,'Anthony Bussonnais','9782253134732',352,'2019-09-21','Claire, inquiète, consulte à nouveau son portable. Il est vingt heures passées et son petit-ami, qui était censé venir la chercher, est introuvable. Cela fait bientôt six mois qu’ils sont ensemble, Claire le connaît bien. Medhi est toujours à l’heure. François est extrêmement organisé. Grâce à lui, la soirée du samedi est devenue un évènement incontournable que ses voisins, choisis avec le plus grand soin, ne rateraient pour rien au monde. C’est le moment idéal pour décompresser et se relâcher. En plein cœur de la forêt, Medhi est nu. Il tremble. Malgré l’obscurité, il parvient à repérer plusieurs personnes autour de lui, les rires vont bon train, tout le monde semble à la fête… Mais qu’attend-on vraiment de lui ?',115),
(54,'Fabrice Humbert','9782702194379',200,'2025-08-20','«  Autrefois, nous étions tous inoffensifs. Nous avions tous ou presque ces visages un peu niais, dénués de caractère. […] Nous étions inoffensifs et nous aurions dû le rester pour demeurer des hommes. » Un homme parle. Il raconte sa fuite hors de Paris, avec ses deux enfants. La ville, en proie à la guerre civile, est en feu. Il veut rejoindre une République du Jura sans doute illusoire.\r\n\r\nDans un pays dévasté par le conflit, sa seule mission doit être de préserver les siens de la cruauté. La route, parcourue en voiture, à dos d’âne et souvent à pied, sera longue. Elle sera semée de dangers mortels, illuminée par la beauté de certaines rencontres. À travers champs, à  travers bois, il tâche de se raccrocher à ce qu’il peut conserver d’humanité et d’amour. Ce roman haletant aux allures de conte ou de rêve évoque autant notre pays que l’itinéraire d’un homme vers l’essence de  la vie.',155),
(55,'Marlène Charine','9782702193228',300,'2025-10-15','Claire a disparu, et le monde de Yohan, son mari, s’écroule. Il en est persuadé, jamais elle ne les aurait quittés volontairement, lui et leur bébé de cinq mois.\r\n \r\nRongé par l’angoisse, furieux d’être suspecté par la police, il se lance seul dans l’enquête.\r\n \r\nC’est alors que surgit une inconnue prétendant être une amie de Claire et détenir la clé du mystère. Selon elle, tout s’est noué en Bourgogne, au début des années 2000, quand Claire était adolescente. Une période dont elle n’a jamais parlé à Yohan…\r\n \r\nQui est vraiment Claire ? Victime, coupable, ou prisonnière d’un passé que personne ne veut affronter ? Une chose est sûre, Yohan ne reculera devant rien pour retrouver la femme qu’il aime, la mère de son fils – celle qu’il pensait connaître.\r\n ',156),
(56,'Donato Carrisi','9782702194324',320,'2025-10-01','Toutes les nuits, Matias, neuf ans, affirme que ses rêves sont hantés par une dame silencieuse vêtue de noir, au point que le petit développe une phobie du sommeil. Désespérés, ses parents se tournent alors vers Pietro Gerber, l’illustre hypnotiseur d’enfants, afin de le soigner.\r\n \r\nAu fil des séances, Gerber comprend que l’histoire racontée par Matias révèle des indices sur un crime irrésolu depuis des années. Et que le sort d’une inconnue pourrait bien dépendre de cette enquête où le réel et le surnaturel se confondent. Afin de sauver les innocents d’une menace hors norme, Pietro Gerber devra défier les lois de la raison et affronter les démons de son passé.\r\n \r\nDans ce nouveau thriller psychologique, Donato Carrisi nous plonge dans un labyrinthe de dangereux faux semblants.',157),
(57,'René Manzor','9782702190791',400,'2025-09-03','Peter a 11 ans. Son père a quitté sa famille pour vivre seul dans un lieu qu’il tient secret. Pour toute explication, il a dit à sa femme que leur sécurité à tous les trois en dépendait. Mais, une nuit de tempête, il surgit chez eux, blessé, et les embarque dans un minivan, direction la Pennsylvanie.\r\n \r\nConfusément, Peter a toujours su que ce jour arriverait. Chaque weekend depuis deux ans, son père l’entraîne au tir sur cible, à l’endurance, au combat à mains nues… Et entre deux exercices physiques, il l’initie aux échecs, lui fait apprendre par cœur des stratégies, des numéros de téléphone, des codes…\r\n \r\nMenacé par des ennemis dont Peter ignore tout, son père a prévu jusqu’au moindre détail de leur exil. Malheureusement, le destin s’en mêle sous la forme d’un terrible accident. Peter et sa mère se retrouvent seuls pour affronter l’avenir, isolés dans une ferme en plein territoire amish, un monde hors de toute modernité.\r\n \r\nDans cette région inconnue, dans cette maison inconnue, Peter ne sait qu’une chose : « Ils viendront », comme lui a dit son père. Mais qui ? Quand et pourquoi ? Et que peut faire un garçon de 11 ans pour protéger sa mère ?',158),
(58,'Alexandra Julhiet','9782702192733',380,'2025-05-07','Quand Angèle, 39 ans, se réveille en sursaut après s’être endormie dans sa baignoire, elle découvre deux mots tracés dans la buée de son miroir : « Va crever ». Quelqu’un l’a attendue chez elle pour la menacer. Qui ? Et pourquoi ?\r\n \r\nTerrifiée, perdue, Angèle accepte de partir quelque temps avec son père, ancien psychiatre affaibli par l’âge, dans le village des Pyrénées où elle a passé sa petite enfance. Là-bas, c’est bientôt la fête de l’Ours : une semaine de célébrations traditionnelles qui s’achève par une longue nuit où les jeunes hommes, enduits de suie et vêtus de peaux de bêtes, deviennent à la fois chasseurs et chassés…\r\n \r\nMalgré le paysage grandiose de ces montagnes préservées, Angèle sent grandir autour d’elle une ambiance sourdement hostile. Comment est-il possible que personne ici ne se souvienne d’elle ? Que cache cette chambre fermée à clé dans la maison de son père ? Le vieil homme fait-il semblant d’avoir perdu la mémoire ? En cherchant à obtenir des réponses, Angèle va découvrir qu’il est parfois extrêmement dangereux de déchirer le voile du mensonge\r\n ',159),
(59,'Jacques Expert','9782702185292',350,'2025-05-21','La famille Delaporte est un modèle de réussite. Jean-Pierre, patriarche charismatique, règne sur son clan comme sur ses affaires : avec assurance, flair… et séduction. Ses deux fils, Tristan et Julien, semblent avoir tout pour être heureux.\r\n \r\nJusqu’au jour où Nathalie surgit dans leur vie.\r\nElle prétend être leur sœur, la fille adultérine de Jean-Pierre.\r\n \r\nSon arrivée fissure lentement les fondations de cette famille unie. Jean-Pierre, aveuglé par l’apparition de cette fille « tombée du ciel », lui accorde une confiance sans borne. Et si Tristan veut la croire, Julien s’y refuse.\r\n \r\nAlors ? Cette femme est-elle leur sœur inespérée ou une manipulatrice décidée à voler ’héritage et à détruire les Delaporte ?',160),
(60,'Niko Tackian','9782702191606',282,'2025-03-05','Dans un hôpital du sud de la France, Julien reprend conscience, ayant tout oublié de ce qui l’a conduit là, mais mû par une certitude : Chloé, sa femme, court un grand danger. Il doit lui venir en aide.\r\nChloé, elle, se souvient de tout, depuis son enlèvement devant un centre commercial jusqu’à son réveil dans cet appartement factice, sans porte, aux fenêtres murées, entièrement équipé pour la vie de couple.\r\nSon seul contact avec l’extérieur, un homme masqué qui lui explique qu’il va faire d’elle sa femme parfaite.\r\nGrondant autour d’eux, la menace est bien là. Mais quelle est-elle ?',161),
(61,'Ludovic Mélon','9782702192870',288,'2024-10-30','Une nouvelle aventure de la plus drôle des brigades « Vous avez sept jours pour m’apporter la preuve de l’existence de ce trésor. » Oliver, le maire de la pas si charmante ville de Maird, est sur le banc des accusés pour avoir détruit à coups de canon la maison de son prédécesseur. Quand il explique qu’il cherchait la carte du trésor que l’on dit caché dans une mine, sous la ville, l’impitoyable juge Calebasse accepte de lui laisser le bénéfice du doute. Mais, pour rester libre, Oliver doit découvrir l’entrée de la mine avant une semaine.\r\n \r\nPendant ce temps, la Brigade des buses, dirigée par Jack, le meilleur ami et meilleur complice d’Oliver, enquête sur une disparition inquiétante. Celle du fossoyeur de la voie des Tombes. Tous connaissent la sinistre réputation de cette ruelle, née il y a vingt-cinq ans, quand des enfants ont disparu.\r\nOn en a retrouvé une bonne partie à l’époque. Enfin, « une bonne partie de chacun d’eux », comme dit le  brigadier Arthur…',162),
(62,'Nita Prose','9782702190654',380,'2025-03-27','Molly Gray est une femme de chambre tout sauf ordinaire. Grâce à son souci du détail et sa maîtrise des bonnes manières, elle a gravi les échelons au sein du somptueux hôtel Regency Grand. Mais sa vie est bouleversée lorsque J.D. Grimthorpe, illustre auteur de polars, tombe raide mort en plein milieu du salon de thé de l’établissement.\r\n \r\nAlors que l’affaire menace la réputation du Regency Grand, et que tous les employés sont des suspects, Molly se rend compte qu’elle a un lien important avec la victime. La clé de cette énigme se trouve nichée dans son passé, à l’époque où, enfant, elle accompagnait sa grand-mère dans le mystérieux manoir des Grimthorpe…\r\n \r\nAfin d’aider ses amis, de sauver l’hôtel et d’empêcher un nouveau drame, Molly va se lancer corps et âme dans cette nouvelle enquête haute en couleur !',163),
(63,'Marlène Charine','9782702185957',400,'2024-02-14','À la suite de son témoignage crucial contre son compagnon, criminel de haut vol, Maddy entre dans un programme de protection.\r\nElle repart à zéro, avec une nouvelle identité. Elle que la presse avait surnommée « la muse du vampire » devient professeure dans un institut pour enfants en réinsertion sociale ou présentant des troubles mentaux. Parmi eux, Abel, un petit garçon autiste, qui prétend communiquer avec une mystérieuse « dame rouge » …\r\n \r\nChargé du suivi de Maddy, le commandant Theven continue de nourrir des soupçons envers sa protégée. Et si la justice avait signé un pacte avec le diable en passant un marché avec elle ?',164),
(64,'Niko Tackian','9782702184011',400,'2024-03-06','Tout se noue dans la forêt des Vosges, froide et sombre.\r\n\r\nLoin sous les arbres, deux adolescents sont retrouvés morts, le corps marqué au fer par un triangle noir. C’est un message anonyme qui a alerté les autorités. La police criminelle de Strasbourg dépêche le commandant Max Keller, un flic discret et silencieux. Enfant, il était l’ami sur qui on peut compter, adulte il est devenu un enquêteur remarquable, connu pour son intégrité et sa persévérance.\r\n \r\nAu nord de la même forêt, Pierre Martignas vit dans un chalet perdu. Considéré comme l’un des plus brillants criminologues de sa génération, il s’est coupé du monde depuis que sa dernière expertise s’est terminée en tragédie.\r\nLe sort effroyable de ces deux adolescents va pourtant le sortir de sa retraite.',165),
(65,'Donato Carrisi','9782702188613',350,'2024-10-04','Dans une vieille bâtisse isolée en Toscane, une fillette souffre de maux bien étranges… Lors de phases de transe, Eva semble habitée par le mal et obéit aux ordres d’un ami imaginaire inquiétant.\r\nC’est en tout cas ce que rapporte sa jeune fille au pair à Pietro Gerber, illustre hypnotiseur pour enfants. Ce dernier, traumatisé par sa précédente affaire, hésite à prendre en charge cette patiente.\r\nMais au cours de leurs séances, elle dissémine des indices sur une histoire qui ronge Gerber depuis des décennies : la disparition brutale de son ami, survenue dans son enfance.\r\nComment peut-elle être au courant de détails que même Gerber a enfouis en lui ? En sondant les affres de la mémoire d’Eva, Pietro Gerber va être victime d’un jeu de piste dangereux, qui l’obligera à se confronter à ses pires démons.',166);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrow`
--

DROP TABLE IF EXISTS `borrow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `borrow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `media_id` int(10) unsigned NOT NULL,
  `due_at` date NOT NULL,
  `returned_at` date DEFAULT NULL,
  `borrow_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `borrow_user_id_index` (`user_id`),
  KEY `borrow_media_id_index` (`media_id`),
  CONSTRAINT `borrow_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `medias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `borrow_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrow`
--

LOCK TABLES `borrow` WRITE;
/*!40000 ALTER TABLE `borrow` DISABLE KEYS */;
INSERT INTO `borrow` VALUES
(2,2,21,'2025-10-20',NULL,'0000-00-00'),
(5,5,22,'2025-09-18','2025-10-16','0000-00-00'),
(7,7,3,'2025-07-10',NULL,'0000-00-00'),
(8,8,23,'2025-09-01',NULL,'0000-00-00'),
(9,9,43,'2025-10-23',NULL,'0000-00-00'),
(10,10,4,'2025-06-10',NULL,'0000-00-00'),
(11,11,24,'2025-09-19',NULL,'0000-00-00'),
(13,13,5,'2022-05-27',NULL,'0000-00-00'),
(15,15,45,'2025-10-23','2025-10-21','0000-00-00'),
(18,18,46,'2025-10-23',NULL,'0000-00-00'),
(19,19,7,'2025-10-27',NULL,'0000-00-00'),
(21,22,4,'2025-11-11','2025-10-22','2025-10-20'),
(23,21,4,'2025-11-03','2025-10-22','2025-10-20'),
(27,21,11,'2025-11-03','2025-10-21','2025-10-20'),
(28,27,55,'2025-11-03',NULL,'2025-10-20'),
(29,27,162,'2025-11-03',NULL,'2025-10-20'),
(30,27,35,'2025-11-03',NULL,'2025-10-20'),
(32,21,3,'2025-11-03','2025-10-21','2025-10-20'),
(33,21,4,'2025-11-04','2025-10-22','2025-10-21'),
(34,21,4,'2025-11-04','2025-10-22','2025-10-21'),
(35,21,8,'2025-11-04','2025-10-21','2025-10-21'),
(36,21,8,'2025-11-04','2025-10-21','2025-10-21'),
(38,23,10,'2025-11-04','2025-10-21','2025-10-21'),
(39,21,3,'2025-11-04','2025-10-21','2025-10-21'),
(40,21,3,'2025-11-04','2025-10-21','2025-10-21'),
(41,21,3,'2025-11-04','2025-10-21','2025-10-21'),
(42,21,3,'2025-11-04','2025-10-21','2025-10-21'),
(43,22,10,'2025-11-04','2025-10-21','2025-10-21'),
(44,21,4,'2025-11-04','2025-10-22','2025-10-21'),
(45,21,3,'2025-11-04','2025-10-21','2025-10-21'),
(46,21,5,'2025-11-04','2025-10-21','2025-10-21'),
(47,21,5,'2025-11-04','2025-10-21','2025-10-21'),
(48,3,27,'2025-11-04','2025-10-22','2025-10-21'),
(49,21,4,'2025-11-04','2025-10-22','2025-10-21'),
(50,22,3,'2025-11-04','2025-10-22','2025-10-21'),
(53,23,17,'2025-11-04',NULL,'2025-10-21'),
(54,3,5,'2025-11-05','2025-10-22','2025-10-22'),
(55,28,22,'2025-11-05','2025-10-22','2025-10-22'),
(56,28,55,'2025-11-05','2025-10-22','2025-10-22'),
(57,29,5,'2025-11-05','2025-10-22','2025-10-22'),
(58,21,4,'2025-11-05','2025-10-22','2025-10-22'),
(59,3,9,'2025-11-06',NULL,'2025-10-23');
/*!40000 ALTER TABLE `borrow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_message`
--

DROP TABLE IF EXISTS `contact_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `read_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_message`
--

LOCK TABLES `contact_message` WRITE;
/*!40000 ALTER TABLE `contact_message` DISABLE KEYS */;
INSERT INTO `contact_message` VALUES
(1,'Alice Guest','guest1@example.com','Bonjour, comment m’inscrire ?','2025-10-13 11:14:41','2025-10-23 10:03:49'),
(2,'John Doe','john@example.com','Livre 1984 disponible ?','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(3,'Marc Lenoir','marc.lenoir@example.com','Combien coûte l’adhésion ?','2025-10-13 11:14:41',NULL),
(4,'Sarah Picard','sarah.picard@example.com','Horaires d’ouverture ?','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(5,'Nicolas Vidal','nicolas.vidal@example.com','Proposez-vous des ateliers ?','2025-10-13 11:14:41','2025-10-23 09:24:22'),
(6,'Sophie Roche','sophie.roche@example.com','Puis-je réserver un livre ?','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(7,'Léo Diallo','leo.diallo@example.com','Y a-t-il des réductions étudiants ?','2025-10-13 11:14:41','2025-10-23 09:24:24'),
(8,'Mila Barre','mila.barre@example.com','J’ai perdu ma carte.','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(9,'Tom Rey','tom.rey@example.com','Problème de connexion.','2025-10-13 11:14:41','2025-10-23 09:25:04'),
(10,'Noa Dumas','noa.dumas@example.com','Changer mon email.','2025-10-13 11:14:41',NULL),
(11,'Inès Colin','ines.colin@example.com','Signalement d’un bug.','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(12,'Eden Henry','eden.henry@example.com','Suggestion d’amélioration.','2025-10-13 11:14:41',NULL),
(13,'Lena Mahe','lena.mahe@example.com','Peut-on emprunter des jeux ?','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(14,'Axel Marek','axel.marek@example.com','Délais de retour ?','2025-10-13 11:14:41','2025-10-23 09:24:19'),
(15,'Romy Tessier','romy.tessier@example.com','Don de livres possible ?','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(16,'Noé Garnier','noe.garnier@example.com','Changement d’adresse.','2025-10-13 11:14:41','2025-10-23 09:23:09'),
(17,'Maya Roger','maya.roger@example.com','Recherche d’un livre rare.','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(18,'Yanis Perrin','yanis.perrin@example.com','Réservation pour samedi.','2025-10-13 11:14:41',NULL),
(19,'Léo Weber','leo.weber@example.com','Question carte famille.','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(20,'Iris Adam','iris.adam@example.com','Problème de paiement.','2025-10-13 11:14:41',NULL),
(22,'stephane job','stephane.job@laplateforme.io','super site','2025-10-23 09:33:48','2025-10-23 09:34:02');
/*!40000 ALTER TABLE `contact_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `games` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `editor` varchar(255) NOT NULL,
  `platform` enum('PC','PlayStation','Xbox','Nintendo','Mobile') NOT NULL,
  `age` enum('3','7','12','16','18') NOT NULL,
  `description` text NOT NULL,
  `release_date` date NOT NULL,
  `media_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `games_media_id_index` (`media_id`),
  CONSTRAINT `games_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `medias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES
(2,'Nintendo','Nintendo','3','Jeu de course accessible et compétitif : circuits iconiques, objets délirants, multi local et en ligne. Idéal pour la famille comme l’eSport casual.','2017-04-28',22),
(3,'CD Projekt','PC','18','RPG narratif vaste : enquêtes surnaturelles, choix moraux lourds de conséquences, combats au sabre et à la magie, artisanat et alchimie dans un monde vivant.','2015-05-19',23),
(4,'Sony','PlayStation','18','Aventure post-apo centrée sur le duo Joel/Ellie. Infiltration, survie et récit émotionnel porté par une mise en scène cinématographique.','2013-06-14',24),
(5,'Sony','PlayStation','18','Épopée mythologique nerveuse : système de combat profond, hache retournante, progression RPG et relation père-fils touchante.','2018-04-20',25),
(6,'Supergiant','PC','12','Roguelike rapide et stylé : échappez aux Enfers en combinant bienfaits des dieux et armes évolutives. Narration réactive et rejouabilité élevée.','2020-09-17',26),
(7,'ConcernedApe','PC','3','Simulation de ferme chill : cultures, élevage, pêche, romance, mines et festivals. Liberté totale et communauté modding florissante.','2016-02-26',27),
(8,'Matt Makes Games','Nintendo','7','Plateformer de précision avec dash aérien, difficulté exigeante mais bienveillante, et histoire sur la résilience personnelle.','2018-01-25',28),
(9,'Team Cherry','Nintendo','12','Metroidvania au level design dense, bestiaire marquant et combats fins. Nombreux secrets, cartes profondes et ambiance mélancolique.','2017-02-24',29),
(10,'Insomniac','PlayStation','12','Action super-héros fluide : balancement aérien grisant, combats acrobatiques, New York ouvert et histoire touchant à la responsabilité.','2018-09-07',30),
(11,'Microsoft','Xbox','3','Course en monde ouvert : saisons dynamiques, centaines de véhicules, playlists évènementielles et exploration libre spectaculaire.','2021-11-09',31),
(12,'Nintendo','Nintendo','3','Simulation de village apaisante : île personnalisable, collection, déco et interactions sociales en temps réel.','2020-03-20',32),
(13,'Nintendo','Nintendo','7','Aventure monde ouvert novatrice : physique systémique, sanctuaires, paravoile et liberté d’approche des défis.','2017-03-03',33),
(14,'EA','PC','16','Battle royale nerveux à héros : gunplay affûté, déplacements rapides, pings contextuels et jeu d’équipe stratégique.','2019-02-04',34),
(15,'Epic Games','PC','12','Battle royale et bac à sable créatif : mises à jour fréquentes, événements live et éditeur UEFN pour créer vos propres expériences.','2017-07-21',35),
(16,'Blizzard','PC','12','Hero shooter 6v6 devenu 5v5 : compositions d’équipe, ultimes combinés et objectifs à tenir dans des cartes lisibles et colorées.','2016-05-24',36),
(17,'Mojang','PC','7','Sandbox illimité : survie, construction, redstone, exploration et mods. Une boîte à outils créative intergénérationnelle.','2011-11-18',37),
(18,'Riot Games','PC','16','FPS tactique à compétences : exécution millimétrée, économie de manches, cartes lisibles et méta eSport évolutive.','2020-06-02',38),
(19,'Riot Games','PC','12','MOBA compétitif emblématique : rôles complémentaires, macro/ micro-gestion et stratégie d’équipe au rythme intense.','2009-10-27',39),
(20,'Psyonix','Xbox','3','Foot en voitures : contrôle aérien, rotations d’équipe et mécaniques spectaculaires. Accessible, profond et très compétitif.','2015-07-07',40),
(21,'	ELECTRONIC ARTS','PlayStation','3','Le club vous appartient dans EA SPORTS FC™ 26. Jouez à votre façon avec une expérience de jeu remaniée grâce aux retours de la communauté FC. Le nouveau préréglage de jouabilité réaliste offre une expérience de football plus vraie que nature en mode Carrière, tandis que le préréglage de jouabilité compétitive – basé sur des fondamentaux peaufinés, une cohérence accrue et une réactivité améliorée ','2025-09-26',73),
(22,'Larian Studios','Xbox','18','Constituez votre groupe et retournez aux Royaumes Oubliés dans une histoire d\'amitié, de trahison, de sacrifice et de survie, sur fond d\'attrait du pouvoir absolu.','2023-08-03',74),
(24,'Kepler Interactive','PlayStation','16','À la tête de l\'Expédition 33, partez éliminer la Peintresse pour que plus jamais elle ne peigne la mort. Explorez un monde rappelant la France de la Belle Époque et affrontez des ennemis uniques dans ce RPG au tour par tour avec mécaniques en temps réel.','2025-04-24',79),
(25,'Mangagamer','PlayStation','16',' Vous vous réveillez dans un vieux manoir décrépit. Une femme aux yeux de jade est devant vous. Elle vous informe que vous êtes le maître de la maison et qu\'elle est votre servante. Cependant, vous n\'en avez aucun souvenir. D\'ailleurs, vous ne savez pas qui vous êtes et vous n\'êtes même pas sûr d\'être en vie. La Servante vous invite à la suivre à travers les couloirs désolés du manoir et à contempler les nombreuses tragédies qui ont frappé ses habitants. Vous vous y retrouverez peut-être, vous suggère-t-elle.','2016-05-13',80),
(26,'Square Enix','PlayStation','16','4ème extension de Final Fantasy XIV, qui mettra fin à l\'arc Zodiark et Hydaelin amorcé il y a plus de 10 ans En compagnie de vos amis Héritiers de la Septième Aube, vous avez sauvé le premier reflet du déluge de Lumière. De retour dans le monde primitif, vos réjouissances sont toutefois de courte durée, car un mal du fond des âges s\'apprête à déferler sur la planète. Une apocalypse mythique se profile à l\'horizon et menace d\'engloutir toute vie. Mais vous êtes le Guerrier de la Lumière, et armé des vœux de tous ceux que vous avez rencontrés au cours de vos voyages, vous ne reculerez devant rien, pas même un océan d\'étoiles.','2021-12-07',82),
(27,'Konami','PlayStation','16','Jeu d\'aventure horrifique dans lequel James Sunderland voit sa vie basculer le jour où il reçoit une lettre de sa femme décédée, lui donnant rendez-vous à Silent Hill.','2001-11-23',83),
(28,'Bandai Namco','Xbox','7','Le Royaume des ombres. Un lieu occulté par l\'Arbre-Monde. Celui où la déesse Marika se manifesta pour la première fois. Une contrée dévastée lors d\'une bataille oubliée. Incendiée par la flamme de Messmer. Telle fut la terre d\'exil de Miquella. Après avoir abandonné sa chair, sa force et sa lignée. Tout ce qui en lui miroitait d\'or. Désormais, Miquella attend le retour du Seigneur qui lui fut promis.','2024-06-21',84),
(29,'IO Interactive','PlayStation','16','Entrez dans le monde de l\'assassin ultime. Hitman le monde de l\'assassinat regroupe le meilleur de Hitman, Hitman 2 et Hitman 3, y compris la campagne principale, les modes Contrat, Escalade, Cible fugitive et Freelance, le mode de jeu inspiré du genre roguelike et une option pour y jour en VR.','2022-01-20',85),
(30,'Nintendo','Nintendo','7','Retournez sur le paradis tropical de Donkey Kong. Explorez librement l\'île, retrouvez-y des têtes connues et échangez vos rondelles de banandium contre des statues à l\'effigie des personnages de la série.','2025-07-17',116),
(31,'Capcom','Nintendo','12','Incarnez les personnages incontournables comme Ryu ou la légendaire Chun-Li, ou des nouveaux venus comme Luke, Jamie, Kimberly et bien d\'autres dans ce nouvel opus ! Chaque personnage bénéficie d\'un nouveau design unique et de cinématiques exaltantes pour leurs coups spéciaux !','2023-06-05',117),
(32,'SONY INTERACTIVE ENT.FRANCE SA','PlayStation','18','Partez à l\'aventure aux confins du Japon. Atsu, une mercenaire solitaire, hantée par les fantômes de son passé. Assoiffée de vengeance, elle traverse les paysages sublimes et sauvages du mont Y?tei, au coeur du Japon septentrional, résolue à faire payer ceux qui lui ont tout pris.','2025-10-02',118),
(33,'Nintendo','Nintendo','3','Super Mario Party Jamboree vous invite à explorer un univers coloré et dynamique à travers sept plateaux uniques, chacun regorgeant de surprises et de défis captivants. Les joueurs pourront traverser les Galeries arc-en-ciel et naviguer sur l\'Île Goomba avec son volcan imprévisible. Le retour des plateaux classiques tels que le Pays Western et le Château arc-en-ciel ravira les fans de longue date, tandis que de nouvelles zones comme le Circuit déjanté offrent des courses endiablées. Chaque plateau propose des stratégies distinctes, renforçant l\'attrait du jeu et garantissant des heures de divertissement.','2024-10-17',119),
(34,'UBISOFT','PlayStation','18','Incarnez une shinobi meurtrière et un puissant samouraï légendaire tout en explorant un magnifique monde ouvert plongé dans le chaos','2024-11-15',120),
(35,'Nintendo','Nintendo','7','Dans Miitopia, tout le monde est un Mii ! Qui va jouer le rôle du héros sans peur, de la ravissante princesse ou bien encore du terrifiant avatar du mal ? Tout est possible et c\'est à vous de le décider ! Si vous le voulez, vous pouvez combattre au côté de vos meilleurs amis pour servir le roi, qui sera joué par votre grand-père, pour libérer le monde du grand méchant... qui pourrait avoir le visage de votre mère, qui sait !','2021-05-21',121),
(36,' BANDAI NAMCO ENTERTAINMENT SAS','Xbox','16','L\'expérience de guerre totale ultime. Participez à des combats d\'infanterie intenses aux quatre coins du monde. Dominez les cieux dans des combats aériens. Démolissez votre environnement pour profiter d\'un avantage stratégique. Exercez un contrôle total sur chaque action et mouvement grâce au système de combat kinesthésique. Dans une guerre de chars, d\'avions de chasse et d\'arsenaux massifs, le plus redoutable, c\'est votre escouade. Bienvenue dans Battlefield 6.','2025-10-10',122),
(37,'MICROIDS','Nintendo','3','20 adorables races de chiens et de chats parmi les plus populaires au monde Des mini-jeux pour jouer et prendre soin de votre animal de compagnie Emmenez votre animal se promener dans le parc et rencontrez d\'autres animaux.','2021-10-28',123),
(38,'Nintendo','Nintendo','3','Bowser a encore fait des siennes... et cette fois la mission est double pour Mario !','2021-02-12',124),
(39,'Nintendo','Nintendo','3','Dorénavant, faites la course à travers les circuits interconnectés du monde de Mario Kart World. Dans la Coupe Champignon, par exemple, commencez par vous affronter sur le Circuit Mario Bros., puis enchaînez directement sur une course sur le trajet qui mène jusqu’à Trophéopolis. Et dorénavant, 24 pilotes sont sur la ligne de départ pour encore plus de concurrents à affronter ! Découvrez le tout nouveau mode Survie dans lequel le défi est de rester jusqu’au bout ! Pour éviter l’élimination passez les points de passage en étant classé assez haut. Sur le dernier tour, les 4 derniers pilotes s’affronteront pour la première place ! Faites la course jusqu’à 4 joueurs sur une seule console ou affrontez des proches ou des joueurs du monde entier en ligne. Et avec la nouvelle fonctionnalité Gamechat discutez en ligne, avec vos proches et partagez vos écrans respectifs.','2025-06-05',125),
(40,'Nintendo','Nintendo','3','C\'est l\'heure du grand nettoyage avec Luigi !','2024-06-27',126),
(41,'SONY INTERACTIVE ENT.FRANCE SA','PlayStation','18',' Rejoignez Sam et ses compagnons pour un périple au-delà des UCA et tentez d\'empêcher l\'extinction de l\'humanité. Suivez leur aventure à travers un monde rempli d\'obstacles et d\'ennemis surnaturels, et répondez à cette question : avons-nous bien fait d\'établir des liens ?','2025-06-26',127),
(42,'PLAION','PlayStation','18','Découvrez le meilleur de Black Ops avec une Campagne solo à couper le souffle, une expérience Multijoueur incroyable et le retour épique du mode Zombies par manches.','2024-10-25',128),
(43,'UBISOFT','Nintendo','3','40 NOUVELLES CHANSONS AMUSANTES QUI PLAIRONT À TOUT LE MONDE Il y en a pour tous les goûts dans Just Dance 2025 Edition. Dansez sur des tubes emblématiques, des incontournables de soirées, des grands classiques, des phénomènes d\'Internet et bien plus encore.','2024-10-15',129),
(44,'SONY','PlayStation','7','Accrochez-vous à votre speeder et découvrez chacune de ces planètes uniques, traversant des forêts luxuriantes, des plages de sable fin, des volcans en éruption ou encore d\'autres endroits bien plus surprenants, comme un immense sablier ou la canopée d\'un arbre chantant !','2024-09-06',130),
(45,' Konami','PlayStation','18','Découvrez les origines de l\'agent emblématique Snake et percez le mystère de la série de jeux vidéo METAL GEAR !','2025-08-18',131),
(46,'Nintendo','Nintendo','7','Rejoignez Mario dans une vaste aventure en 3D à travers le globe et servez-vous de ses incroyables nouvelles capacités pour récolter des lunes afin d\'alimenter votre vaisseau, l\'Odyssée, et de venir à la rescousse de la Princesse Peach qui a une nouvelle fois été kidnappée par Bowser !','2017-10-27',132),
(47,'Capcom','PlayStation','18','Ethan Winters et son épouse Mia, commencent une nouvelle vie paisible, enfin libérés de leur passé tortueux. Le sort s\'acharne de nouveau sur eux lorsque Chris Redfield du BSAA enlève leur fille. Ethan doit affronter l\'enfer pour retrouver sa fille.','2021-05-07',133),
(48,'Square Enix','PlayStation','18','Découvrez l\'épopée du guerrier Clive Rosfield, Gardien de Rosalia ayant juré de protéger son jeune frère Joshua, l\'Émissaire de Phénix.','2023-06-22',134),
(61,'wah','Nintendo','3','aa','1999-11-11',176);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `genres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `genres_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES
(17,'Action'),
(16,'Action-Adventure'),
(13,'Action-RPG'),
(22,'Adventure'),
(34,'Animation'),
(7,'Classique'),
(27,'Comédie'),
(4,'Conte'),
(29,'Crime'),
(11,'Cyberpunk'),
(32,'Drame'),
(1,'Dystopie'),
(3,'Essai'),
(2,'Fantasy'),
(28,'Historique'),
(10,'Horreur'),
(21,'Metroidvania'),
(25,'MOBA'),
(31,'Musical'),
(20,'Platformer'),
(8,'Polar'),
(14,'Racing'),
(18,'Rogue-like'),
(5,'Roman'),
(30,'Romance'),
(15,'RPG'),
(24,'Sandbox'),
(6,'Sci-Fi'),
(12,'SF'),
(23,'Shooter'),
(19,'Simulation'),
(26,'Sports'),
(9,'Thriller'),
(33,'Western');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medias`
--

DROP TABLE IF EXISTS `medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `medias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `type` enum('Film','Jeu','Livre') NOT NULL DEFAULT 'Film',
  `genre_id` int(10) unsigned NOT NULL,
  `date_publication` date NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `availability` int(11) NOT NULL DEFAULT 0,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `medias_genre_id_index` (`genre_id`),
  CONSTRAINT `medias_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medias`
--

LOCK TABLES `medias` WRITE;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;
INSERT INTO `medias` VALUES
(3,'Sapiens','https://m.media-amazon.com/images/I/811PTyrckTL.jpg','Livre',3,'2015-09-10',4,'2025-10-13 11:14:42','2025-10-22 16:33:11',0,1),
(4,'Le Petit Prince','https://bookscouter.com/_next/image?url=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F41QOmta3TmL._SL300_.jpg&w=1920&q=75','Livre',4,'2015-01-01',6,'2025-10-13 11:14:42','2025-10-22 16:03:40',-1,1),
(5,'L\'Étranger','https://actualitte.com/uploads/images/L-Etranger-Albert-Camus-8194df87-8151-463a-8eca-4eb90126f7dc.jpg','Livre',5,'2012-03-15',4,'2025-10-13 11:14:42','2025-10-22 16:21:37',0,1),
(7,'Fondation','https://images.noosfere.org/couv/p/pdf089-1987.jpg','Livre',6,'2018-02-11',2,'2025-10-13 11:14:42','2025-10-21 11:36:51',0,1),
(8,'La Peste','https://www.larousse.fr/encyclopedie/data/images/1315733-Albert_Camus_La_Peste.jpg','Livre',5,'2011-10-10',3,'2025-10-13 11:14:42','2025-10-21 11:36:51',0,1),
(9,'Les Misérables','https://bookscouter.com/_next/image?url=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F516TT%2BD4DZL._SL300_.jpg&w=1920&q=75','Livre',7,'2010-09-01',2,'2025-10-13 11:14:42','2025-10-23 11:00:41',1,1),
(10,'Harry Potter 1','https://bookscouter.com/_next/image?url=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F5152XTq24%2BL._SL300_.jpg&w=1920&q=75','Livre',2,'2007-09-01',7,'2025-10-13 11:14:42','2025-10-21 14:54:57',0,1),
(11,'Harry Potter 2','https://bookscouter.com/_next/image?url=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F51n-RPrkgSL._SL200_.jpg&w=1920&q=75','Livre',2,'2008-09-01',7,'2025-10-13 11:14:42','2025-10-21 11:13:26',0,1),
(12,'Harry Potter 3','https://bookscouter.com/_next/image?url=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F51CLmyCCJnL._SL200_.jpg&w=1920&q=75','Livre',2,'2009-09-01',6,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(13,'Le Nom de la Rose','https://cdn1.booknode.com/book_cover/0/full/le-nom-de-la-rose-456.jpg','Livre',8,'2016-05-05',3,'2025-10-13 11:14:42','2025-10-21 11:36:51',0,1),
(14,'Da Vinci Code','https://bookscouter.com/_next/image?url=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F4182WHOHqUL._SL200_.jpg&w=1920&q=75','Livre',9,'2013-04-20',5,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(15,'Shining','https://bookscouter.com/_next/image?url=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F51iytv%2BIivL._SL200_.jpg&w=1920&q=75','Livre',10,'2014-10-31',4,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(16,'It','https://www.bepolar.fr/local/cache-vignettes/L223xH360/arton7919-a65fc-de5c3.jpg?1736783838','Livre',10,'2015-10-31',4,'2025-10-13 11:14:42','2025-10-16 16:05:50',0,1),
(17,'Neuromancien','https://static.fnac-static.com/multimedia/PE/Images/FR/NR/51/55/bb/12277073/1540-1/tsp20250828093122/Neuromancien.jpg','Livre',11,'2017-07-07',3,'2025-10-13 11:14:42','2025-10-21 15:03:41',1,1),
(18,'Le Silmarillion','https://m.media-amazon.com/images/I/51A7ZT7gJWL._UF1000,1000_QL80_.jpg','Livre',2,'2005-03-02',2,'2025-10-13 11:14:42','2025-10-16 15:57:17',0,1),
(19,'La Horde du Contrevent','https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcQZXS8s5IjpNNhrpwKrfNDPZlE_h2gv4BlpLSGc1lVbv6hM_1POIvPNiXLEnlYpjiX_GuNow--qw6X6kCfQq6SKNDjL6qs-WeokvzQqtOU','Livre',2,'2011-11-11',2,'2025-10-13 11:14:42','2025-10-16 15:48:17',0,1),
(20,'La Nuit des Temps','https://cdn1.booknode.com/book_cover/0/full/la-nuit-des-temps-433.jpg','Livre',12,'2010-12-12',3,'2025-10-13 11:14:42','2025-10-16 15:58:42',0,1),
(21,'Elden Ring','https://cdn.thegamesdb.net/images/thumb/boxart/front/88060-1.jpg','Jeu',13,'2022-02-25',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(22,'Mario Kart 8 Deluxe','https://cdn.thegamesdb.net/images/thumb/boxart/front/42294-1.jpg','Jeu',14,'2017-04-28',6,'2025-10-13 11:14:42','2025-10-22 13:50:38',0,1),
(23,'The Witcher 3','https://image.api.playstation.com/vulcan/ap/rnd/202211/0711/kh4MUIuMmHlktOHar3lVl6rY.png','Jeu',15,'2015-05-19',3,'2025-10-13 11:14:42','2025-10-16 16:00:00',0,1),
(24,'The Last of Us','https://m.media-amazon.com/images/I/819Y2JhjAFL._UF1000,1000_QL80_.jpg','Jeu',16,'2013-06-14',2,'2025-10-13 11:14:42','2025-10-16 15:53:11',0,1),
(25,'God of War','https://cdn.thegamesdb.net/images/thumb/boxart/front/102503-1.jpg','Jeu',17,'2018-04-20',3,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(26,'Hades','https://cdn.thegamesdb.net/images/thumb/boxart/front/78275-1.jpg','Jeu',18,'2020-09-17',4,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(27,'Stardew Valley','https://cdn.thegamesdb.net/images/thumb/boxart/front/35320-1.png','Jeu',19,'2016-02-26',5,'2025-10-13 11:14:42','2025-10-22 10:05:21',0,1),
(28,'Celeste','https://cdn.thegamesdb.net/images/thumb/boxart/front/53935-1.jpg','Jeu',20,'2018-01-25',3,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(29,'Hollow Knight','https://cdn.thegamesdb.net/images/thumb/boxart/front/43548-1.jpg','Jeu',21,'2017-02-24',4,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(30,'Spider-Man','https://cdn.thegamesdb.net/images/thumb/boxart/front/54488-1.jpg','Jeu',17,'2018-09-07',3,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(31,'Forza Horizon 5','https://cdn.thegamesdb.net/images/thumb/boxart/front/88500-1.jpg','Jeu',14,'2021-11-09',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(32,'Animal Crossing','https://cdn.thegamesdb.net/images/thumb/boxart/front/104721-1.jpg','Jeu',19,'2020-03-20',6,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(33,'Zelda BOTW','https://cdn.thegamesdb.net/images/thumb/boxart/front/129885-1.jpg','Jeu',22,'2017-03-03',5,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(34,'Apex Legends','https://cdn.thegamesdb.net/images/thumb/boxart/front/63344-1.jpg','Jeu',23,'2019-02-04',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(35,'Fortnite','https://cdn.thegamesdb.net/images/thumb/boxart/front/53456-1.jpg','Jeu',23,'2017-07-21',2,'2025-10-13 11:14:42','2025-10-20 16:21:30',1,1),
(36,'Overwatch','https://m.media-amazon.com/images/I/81hLqb39yfL._UF894,1000_QL80_.jpg','Jeu',23,'2016-05-24',3,'2025-10-13 11:14:42','2025-10-16 16:03:32',0,1),
(37,'Minecraft','https://cdn.thegamesdb.net/images/thumb/boxart/front/50424-1.jpg','Jeu',24,'2011-11-18',8,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(38,'Valorant','https://cdn.thegamesdb.net/images/thumb/boxart/front/128761-1.jpg','Jeu',23,'2020-06-02',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(39,'League of Legends','https://cdn.thegamesdb.net/images/thumb/boxart/front/928-1.jpg','Jeu',25,'2009-10-27',4,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(40,'Rocket League','https://cdn.thegamesdb.net/images/thumb/boxart/front/29478-1.jpg','Jeu',26,'2015-07-07',3,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(43,'Le Fabuleux Destin d\'Amélie Poulain','https://media.themoviedb.org/t/p/w188_and_h282_bestv2/tdXtLG6L1QMwrv0MNdW6B9IwC8B.jpg','Film',27,'2001-04-25',3,'2025-10-13 11:14:42','2025-10-15 15:36:13',0,1),
(45,'Le Parrain','https://www.themoviedb.org/t/p/w1280/k3uIbYtiuK8pwbCcbma29nTqmgG.jpg','Film',29,'1972-03-24',2,'2025-10-13 11:14:42','2025-10-21 13:52:53',-1,1),
(46,'Titanic','https://www.themoviedb.org/t/p/w1280/vpsvHLkoeKUjceIMeNSqCp3xEyY.jpg','Film',30,'1997-12-19',3,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(47,'Matrix','https://storage.googleapis.com/pod_public/750/106922.jpg','Film',6,'1999-03-31',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(48,'Avatar','https://www.themoviedb.org/t/p/w1280/v5Y8pVwJK68SKQQ1GRbIB1hkPDy.jpg','Film',6,'2009-12-18',3,'2025-10-13 11:14:42','2025-10-14 11:22:48',0,1),
(50,'Parasite','https://fr.web.img5.acsta.net/c_310_420/pictures/20/02/12/13/58/3992754.jpg','Film',9,'2019-05-30',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(51,'The Dark Knight','https://www.themoviedb.org/t/p/w1280/pyNXnq8QBWoK3b37RS6C3axwUOy.jpg','Film',17,'2008-07-18',3,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(52,'Whiplash','https://m.media-amazon.com/images/I/914trm0WbIL._UF894,1000_QL80_.jpg','Film',32,'2014-10-10',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(53,'Django Unchained','https://fr.web.img4.acsta.net/c_310_420/medias/nmedia/18/90/08/59/20366454.jpg','Film',33,'2012-12-25',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(54,'Mad Max: Fury Road','https://fr.web.img6.acsta.net/c_310_420/pictures/15/04/14/18/30/215297.jpg','Film',17,'2015-05-15',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(55,'Up','https://www.themoviedb.org/t/p/w1280/k55kMEPkxGej70udPcVNqhTiwBz.jpg','Film',34,'2009-05-29',2,'2025-10-13 11:14:42','2025-10-22 13:57:58',1,1),
(56,'Coco','https://www.themoviedb.org/t/p/w1280/sZqcEV3KhDITHlUBmyj1a3RRvT9.jpg','Film',34,'2017-10-20',3,'2025-10-13 11:14:42','2025-10-14 11:19:42',0,1),
(57,'Joker','https://www.themoviedb.org/t/p/w1280/tWjJ3ILjsbTwKgXxEv48QAbYZ19.jpg','Film',32,'2019-10-04',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(58,'Dune (Film)','https://www.themoviedb.org/t/p/w1280/qpyaW4xUPeIiYA5ckg5zAZFHvsb.jpg','Film',6,'2021-10-22',3,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(59,'Blade Runner 2049','https://www.themoviedb.org/t/p/w1280/qWD9E0Wgn8w6nMMutCNFAUiSHrX.jpg','Film',6,'2017-10-06',1,'2025-10-13 11:14:42','2025-10-15 15:08:34',0,1),
(60,'Your Name','https://www.themoviedb.org/t/p/w1280/zyHjvVRgKOt9wgVx4ikp2kGArGF.jpg','Film',34,'2016-08-26',2,'2025-10-13 11:14:42','2025-10-13 14:30:48',0,1),
(64,'Les Années glorieuses','https://www.babelio.com/couv/CVT_Un-avenir-radieux_7870.jpg','Livre',5,'2025-01-21',1,'2025-10-15 12:02:53','2025-10-15 15:07:09',0,1),
(65,'Mickey 17','https://media.senscritique.com/media/000022619981/300/mickey_17.png','Film',6,'2025-03-05',1,'2025-10-15 13:17:12','2025-10-15 15:07:09',0,1),
(66,'Sinners','https://media.senscritique.com/media/000022770200/300/sinners.png','Film',10,'2025-04-16',1,'2025-10-15 13:20:34','2025-10-15 15:07:09',0,1),
(67,'Life of Chuck','https://media.senscritique.com/media/000023093209/300/the_life_of_chuck.png','Film',32,'2025-06-11',1,'2025-10-15 13:23:44','2025-10-15 15:07:09',0,1),
(68,'Black Dog','https://media.senscritique.com/media/000022763169/300/black_dog.png','Film',32,'2025-03-05',1,'2025-10-15 13:26:38','2025-10-15 15:07:09',0,1),
(69,'Mémoires d’un escargot','https://media.senscritique.com/media/000022500290/300/memoires_dun_escargot.png','Film',34,'2025-01-15',1,'2025-10-15 13:28:50','2025-10-15 15:07:09',0,1),
(70,'Bird','https://media.senscritique.com/media/000022481993/300/bird.png','Film',32,'2025-01-01',1,'2025-10-15 13:31:55','2025-10-15 15:07:09',0,1),
(71,'Ta promesse','https://images.epagine.fr/238/9782072912238_1_75.jpg','Livre',5,'2025-01-02',1,'2025-10-15 13:37:00','2025-10-15 15:07:09',0,1),
(72,'Lux','https://assests.bookvillage.app/photos/books/cover-thumbnails/xlarge/a6bcddaf-9e07-453a-8fee-d937a69502bc-v1.jpg','Livre',8,'2025-02-06',0,'2025-10-15 13:43:15','2025-10-15 15:07:09',0,1),
(73,'Ea Sports Fc 26 PS5','https://www.micromania.fr/dw/image/v2/BCRB_PRD/on/demandware.static/-/Sites-masterCatalog_Micromania/default/dw26829fc5/images/high-res/152322.jpg','Jeu',26,'2025-09-26',2,'2025-10-15 13:55:53','2025-10-15 15:07:09',0,1),
(74,'Baldur\'s Gate III','https://media.senscritique.com/media/000022495251/300/baldur_s_gate_iii.jpg','Jeu',16,'2023-08-03',10,'2025-10-15 14:06:07','2025-10-17 13:38:31',0,1),
(79,'Clair Obscur: Expedition 33','https://media.senscritique.com/media/000022881617/300/clair_obscur_expedition_33.png','Jeu',13,'2025-04-24',1,'2025-10-15 14:41:54','2025-10-15 15:07:56',0,1),
(80,'The House in Fata Morgana','https://media.senscritique.com/media/000020936560/300/the_house_in_fata_morgana.png','Jeu',16,'2016-05-13',1,'2025-10-15 14:45:13','2025-10-15 15:07:56',0,1),
(82,'Final Fantasy XIV: Endwalker','https://media.senscritique.com/media/000020995579/300/final_fantasy_xiv_endwalker.png','Jeu',16,'2021-12-07',1,'2025-10-15 15:50:00','2025-10-15 15:50:00',1,1),
(83,'Silent Hill 2','https://sm.ign.com/ign_fr/cover/s/silent-hil/silent-hill-2-remake_87rs.jpg','Jeu',16,'2001-11-23',1,'2025-10-15 15:52:39','2025-10-16 15:51:27',1,1),
(84,'Elden Ring: Shadow of the Erdtree','https://media.senscritique.com/media/000021934574/300/elden_ring_shadow_of_the_erdtree.png','Jeu',13,'2024-06-21',1,'2025-10-15 15:55:36','2025-10-15 15:55:36',1,1),
(85,'Hitman: World of Assassination','https://media.senscritique.com/media/000022378873/300/hitman_world_of_assassination.jpg','Jeu',16,'2022-01-20',1,'2025-10-15 15:58:50','2025-10-15 15:58:50',1,1),
(86,'Alchemised','https://media.senscritique.com/media/000022829667/300/alchemised.webp','Livre',2,'2025-10-01',1,'2025-10-15 16:04:32','2025-10-15 16:04:32',1,1),
(87,'Cyberpunk Le nouveau système totalitaire','https://media.senscritique.com/media/000023098949/300/cyberpunk.jpg','Livre',3,'2025-09-19',1,'2025-10-15 16:08:05','2025-10-15 16:08:05',1,1),
(88,'Le Bon, la Brute et le Truand','https://media.senscritique.com/media/000008032023/300/le_bon_la_brute_et_le_truand.jpg','Film',33,'1968-03-08',1,'2025-10-15 16:28:18','2025-10-15 16:28:18',1,1),
(89,'L\'Aurore','https://cinevallee.fr/wp-content/uploads/2020/02/Affiche1NB.jpg','Film',32,'1928-10-11',1,'2025-10-15 16:31:29','2025-10-16 16:09:23',1,1),
(90,'Vol au-dessus d\'un nid de coucou','https://media.senscritique.com/media/000016145216/300/vol_au_dessus_d_un_nid_de_coucou.jpg','Film',32,'1976-03-01',1,'2025-10-15 16:34:08','2025-10-15 16:34:08',1,1),
(91,'Apocalypse Now','https://media.senscritique.com/media/000012235164/300/apocalypse_now.jpg','Film',32,'1979-09-26',1,'2025-10-15 16:36:52','2025-10-15 16:36:52',1,1),
(92,'Inception','https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/72/34/14/19476654.jpg','Film',12,'2010-06-07',1,'2025-10-16 09:42:30','2025-10-16 09:42:30',1,1),
(93,'Le Seigneur des Anneaux','https://static.fnac-static.com/multimedia/PE/Images/FR/NR/e2/25/3f/4138466/1507-1/tsp20250325123933/Le-seigneur-des-anneaux-Integrale.jpg','Livre',2,'1955-01-01',1,'2025-10-16 09:47:20','2025-10-16 09:47:20',1,1),
(94,'The boyfriend','https://static.fnac-static.com/multimedia/PE/Images/FR/NR/a2/8a/17/18320034/1545-1/tsp20241113071103/THE-BOYFRIEND.jpg','Livre',5,'2025-10-08',1,'2025-10-16 09:54:33','2025-10-16 09:54:33',1,1),
(95,'Le roman maudit','https://static.fnac-static.com/multimedia/PE/Images/FR/NR/74/55/1f/18830708/1540-1/tsp20251015194539/Le-roman-maudit-Thriller-de-l-avent.jpg','Livre',9,'2025-09-25',1,'2025-10-16 09:58:10','2025-10-16 09:58:10',1,1),
(96,'INTERSTELLAR','https://fr.web.img5.acsta.net/c_310_420/pictures/14/09/24/12/08/158828.jpg','Film',12,'2014-11-05',1,'2025-10-16 10:03:33','2025-10-16 10:03:33',1,1),
(97,'GLADIATOR','https://fr.web.img5.acsta.net/c_310_420/medias/nmedia/18/68/64/41/19254510.jpg','Film',16,'2000-06-20',1,'2025-10-16 10:07:18','2025-10-16 10:07:18',1,1),
(98,'La femme de ménage voit tout','https://static.fnac-static.com/multimedia/PE/Images/FR/NR/d1/0f/23/19075025/1540-1/tsp20251015191517/La-femme-de-menage-voit-tout.jpg','Livre',5,'2025-10-08',1,'2025-10-16 11:01:52','2025-10-16 11:01:52',1,1),
(99,'Tenir debout','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253251712-001-X.jpeg?source=web','Livre',5,'2025-08-20',1,'2025-10-16 11:10:09','2025-10-16 11:10:09',1,1),
(100,'Jacaranda','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253252030-001-X.jpeg?source=web&v=ea3df8ab7872cd888cefd1c0bf4354ed','Livre',5,'2025-10-01',1,'2025-10-16 11:14:32','2025-10-16 11:14:32',1,1),
(101,'Plus grand que le ciel','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253251675-001-X.jpeg?source=web','Livre',5,'2025-05-07',1,'2025-10-16 11:16:48','2025-10-16 11:16:48',1,1),
(102,'Les Morts ont la parole','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253252559-001-X.jpeg?source=web','Livre',3,'2025-08-27',1,'2025-10-16 11:19:20','2025-10-16 11:19:20',1,1),
(103,'Les Yeux de Mona','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253907947-001-X.jpeg?source=web&v=247c098341222a7b91b39e51b4715dfb','Livre',5,'2025-05-21',1,'2025-10-16 11:21:57','2025-10-16 11:21:57',1,1),
(104,'Chambre 505','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253254812-001-T.jpeg?source=web','Livre',8,'2025-09-17',1,'2025-10-16 11:24:10','2025-10-16 11:24:10',1,1),
(105,'Au premier regard','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253253402-001-X.jpeg?source=web','Livre',9,'2025-08-20',1,'2025-10-16 11:26:31','2025-10-16 11:26:31',1,1),
(106,'Petit Pays','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2018/9782253070443-001-X.jpeg?source=web&v=0748c0f1af0b4e058740805618352821','Livre',5,'2017-08-23',1,'2025-10-16 11:31:08','2025-10-16 11:31:08',1,1),
(107,'La Valse des âmes','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253909927-001-X.jpeg?source=web&v=0a5eccc37fb6fc2eda0c2668b0ff7000','Livre',10,'2025-10-01',1,'2025-10-16 11:34:24','2025-10-16 11:34:24',1,1),
(108,'Sans l\'ombre d\'un doute','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253254577-001-X.jpeg?source=web','Livre',8,'2025-08-27',1,'2025-10-16 11:37:05','2025-10-16 11:37:05',1,1),
(109,'Chats sur ordonnance','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253256328-001-X.jpeg?source=web&v=c519bb53eecf591b7b1f05e25cd9d36e','Livre',5,'2025-10-01',1,'2025-10-16 11:39:17','2025-10-16 11:39:17',1,1),
(110,'Les sept Soeurs','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2022/9782253262329-001-X.jpeg?source=web&v=55cd61a34559aac2f1698b0bba241116','Livre',5,'2020-06-03',1,'2025-10-16 11:44:14','2025-10-16 11:44:14',1,1),
(111,'Marche ou crève','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253151395-001-X.jpeg?source=web','Livre',10,'2025-12-06',1,'2025-10-16 11:47:51','2025-10-16 11:47:51',1,1),
(112,'L\'Éducation des papillons','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2025/9782253254553-001-X.jpeg?source=web&v=12cbc124e143faf99a557801ebca4049','Livre',9,'2025-10-01',1,'2025-10-16 11:52:40','2025-10-16 11:52:40',1,1),
(113,'Les Armes de la lumière','https://media.hachette.fr/fit-in/500x500/imgArticle/LGFLIVREDEPOCHE/2024/9782253071563-001-X.jpeg?source=web','Livre',28,'2025-01-02',1,'2025-10-16 11:57:00','2025-10-16 11:57:00',1,1),
(114,'Ses Derniers mots','https://media.hachette.fr/fit-in/500x500/imgArticle/PRELUDES/2021/9782253105183-001-X.jpeg?source=web','Livre',9,'2022-11-09',1,'2025-10-16 13:12:19','2025-10-16 13:12:19',1,1),
(115,'Un samedi soir entre amis','https://media.hachette.fr/fit-in/500x500/imgArticle/PRELUDES/2019/9782253134732-001-X.jpeg?source=web','Livre',5,'2019-09-21',1,'2025-10-16 13:16:10','2025-10-16 13:16:10',1,1),
(116,'Donkey Kong Bananza','https://www.nintendo.com/eu/media/images/assets/nintendo_switch_2_games/donkey_kong_bananza/2x1_NSwitch2_DonkeyKongBananza_Launch_image800w.jpg','Jeu',20,'2025-07-17',1,'2025-10-16 13:41:30','2025-10-16 13:41:30',1,1),
(117,'Street Fighter™ 6','https://www.streetfighter.com/6/contents/assets/images/y12-fe_nsw2/main_visual.jpg','Jeu',17,'2023-06-05',1,'2025-10-16 13:48:32','2025-10-16 16:14:46',1,1),
(118,'GHOST OF YOTEI','https://cdn-uploads.gameblog.fr/img/news/700682_68a2e8db0208d.jpg','Jeu',22,'2025-10-02',1,'2025-10-16 13:57:06','2025-10-16 16:19:07',1,1),
(119,'SUPER MARIO PARTY JAMBOREE','https://boulanger.scene7.com/is/image/Boulanger/0045496512613_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',20,'2024-10-17',1,'2025-10-16 14:00:52','2025-10-16 14:00:52',1,1),
(120,'ASSASSIN\'S CREED SHADOWS','https://boulanger.scene7.com/is/image/Boulanger/3307216292609_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',22,'2024-11-15',1,'2025-10-16 14:04:22','2025-10-16 14:04:22',1,1),
(121,'Miitopia','https://static.fnac-static.com/multimedia/Images/FR/NR/a4/53/c7/13063076/1540-1/tsp20250117091600/Miitopia-Nintendo-Switch.jpg','Jeu',20,'2021-05-21',1,'2025-10-16 14:08:43','2025-10-17 09:08:24',1,1),
(122,'BATTLEFIELD 6','https://image.api.playstation.com/vulcan/ap/rnd/202507/2217/85dfe8edf1f1c357da01bc997dfb346852a89ede08f4a453.png','Jeu',17,'2025-10-10',1,'2025-10-16 14:12:32','2025-10-16 14:57:16',1,1),
(123,'MY UNIVERSE PUPPIES&KITTENS','https://m.media-amazon.com/images/I/71oGK0FrtfL.jpg','Jeu',22,'2021-10-28',1,'2025-10-16 14:15:11','2025-10-16 14:58:48',1,1),
(124,'Super Mario 3D World+Bowser\'s','https://boulanger.scene7.com/is/image/Boulanger/0045496426958_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',20,'2021-02-12',1,'2025-10-16 14:18:03','2025-10-16 14:18:03',1,1),
(125,'Mario Kart World','https://boulanger.scene7.com/is/image/Boulanger/0045496312336_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',17,'2025-06-05',1,'2025-10-16 14:25:55','2025-10-16 14:25:55',1,1),
(126,'Luigi\'s Mansion 2 HD ','https://boulanger.scene7.com/is/image/Boulanger/0045496512156_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',22,'2024-06-27',1,'2025-10-16 14:28:23','2025-10-16 14:28:23',1,1),
(127,'DEATH STRANDING 2 ON THE BEACH','https://boulanger.scene7.com/is/image/Boulanger/0711719599920_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',22,'2025-06-26',1,'2025-10-16 14:31:25','2025-10-16 14:31:25',1,1),
(128,'Call Of Duty BLACK OPS 6 ','https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcT6_vWZqs45xIrVjPvIQJiT31Fzh5PZoiJZL3wiwe7y83M8hphA6vfzQLobjGbO4yRandRB35b6M7U9GohsVms31EHplYHu','Jeu',17,'2024-10-25',1,'2025-10-16 14:34:47','2025-10-16 14:35:46',1,1),
(129,'Just Dance 2025 ','https://boulanger.scene7.com/is/image/Boulanger/3307216295716_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',31,'2024-10-15',1,'2025-10-16 14:40:43','2025-10-16 14:40:43',1,1),
(130,'ASTROBOT','https://img.123comparer.fr/images/main/300-300/gy5uncjzgrhukqjt8yauo.webp','Jeu',16,'2024-09-06',1,'2025-10-16 14:43:16','2025-10-16 14:44:15',1,1),
(131,'KONAMI Metal Gear Solid Delta Snake Eater Day','https://boulanger.scene7.com/is/image/Boulanger/4012927150825_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',22,'2025-08-28',1,'2025-10-16 14:47:18','2025-10-16 14:47:18',1,1),
(132,'Super Mario Odyssey ','https://boulanger.scene7.com/is/image/Boulanger/0045496420888_h_f_l_0?wid=2000&hei=2000&resMode=sharp2&op_usm=1.75,0.3,2,0&fmt=png-alpha','Jeu',16,'2017-10-27',1,'2025-10-16 14:50:43','2025-10-16 14:50:43',1,1),
(133,'Resident Evil VILLAGE','https://imgproxy.eneba.games/4RiSrrQxFFiz86WulbpuoJ3nLBDhapA7AsPdEuCwMKs/rs:fit:350/ar:1/czM6Ly9wcm9kdWN0/cy5lbmViYS5nYW1l/cy9wcm9kdWN0cy9Q/eTFxNTB6S295NGVa/X1VDbUNoUXNPZ1Ux/eTRteFoyRzZJVGdj/V24tUEVNLnBuZw','Jeu',10,'2021-05-07',1,'2025-10-16 15:34:27','2025-10-16 15:34:27',1,1),
(134,'FINAL FANTASY XVI ','https://cdn11.bigcommerce.com/s-sdhub7he5o/images/stencil/1280x1280/products/2132/11297/FAITH_SQEX_PACKSHOT_SEE_500x718_PEGI__81233.1684243818.jpg?c=1','Jeu',17,'2023-06-22',1,'2025-10-16 15:39:46','2025-10-16 16:12:50',1,1),
(135,'Deadstream','https://www.themoviedb.org/t/p/w1280/5rsS8m61oHTjoTKfDWVMF3OHnww.jpg','Film',10,'2023-01-24',1,'2025-10-16 16:31:08','2025-10-16 16:31:08',1,1),
(136,'Les Évadés','https://www.themoviedb.org/t/p/w1280/t30GjttOdb5At1sYy8b3TOwFgWV.jpg','Film',32,'1995-03-01',1,'2025-10-16 16:34:47','2025-10-16 16:34:47',1,1),
(137,'La Ligne verte ','https://www.themoviedb.org/t/p/w1280/cRBUYC02CPsVa1GqBq6rfHn5a8g.jpg','Film',32,'2000-03-01',1,'2025-10-16 16:37:24','2025-10-16 16:37:24',1,1),
(153,'test','/uploads/covers/cover_68f2472ad46c96.65600632.jpg','Film',3,'2000-09-09',1,'2025-10-17 15:39:55','2025-10-17 15:39:55',0,1),
(154,'WOAH',NULL,'Film',17,'2025-10-20',5,'2025-10-20 09:26:42','2025-10-20 09:26:42',0,1),
(155,'De l\'autre côté de la vie','https://www.maisondelapresse.com/media/catalog/product/cache/c17f731cd22f67c4cc59dae4e31fab0e/9/7/9782702194379.jpg','Livre',5,'2025-10-20',1,'2025-10-20 09:35:26','2025-10-20 09:35:26',0,1),
(156,'De ma famille','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2025/9782702193228-001-X.jpeg?source=web&v=010ab2610d6e66b2cd5580bcf17157f4','Livre',9,'2025-10-20',1,'2025-10-20 09:40:22','2025-10-20 09:40:22',0,1),
(157,'La Maison des silences','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2025/9782702194324-001-X.jpeg?source=web&v=a6a742428e9b25154abc0750c3743209','Livre',9,'2025-10-20',1,'2025-10-20 09:43:53','2025-10-20 09:43:53',0,1),
(158,'Quand ils viendront','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2025/9782702190791-001-X.jpeg?source=web','Livre',9,'2025-10-20',1,'2025-10-20 09:46:53','2025-10-20 09:46:53',0,1),
(159,'La Nuit de l\'ours','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2025/9782702192733-001-X.jpeg?source=web','Livre',9,'2025-10-20',1,'2025-10-20 09:50:35','2025-10-20 09:50:35',0,1),
(160,'Ma Soeur','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2025/9782702185292-001-X.jpeg?source=web','Livre',9,'2025-10-20',1,'2025-10-20 09:54:27','2025-10-20 09:54:27',0,1),
(161,'La Menace','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2025/9782702191606-001-X.jpeg?source=web','Livre',8,'2025-10-20',1,'2025-10-20 09:57:05','2025-10-20 09:57:05',0,1),
(162,'La Brigade des buses - L\'Emmerdeuse professionnelle','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2024/9782702192870-001-X.jpeg?source=web','Livre',9,'2025-10-20',1,'2025-10-20 09:59:50','2025-10-20 16:21:03',1,1),
(163,'L\'Invité mystère','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2024/9782702190654-001-X.jpeg?source=web','Livre',9,'2025-10-20',1,'2025-10-20 10:04:31','2025-10-20 10:04:31',0,1),
(164,'La Protégée','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2024/9782702185957-001-X.jpeg?source=web','Livre',8,'2025-10-20',1,'2025-10-20 11:10:53','2025-10-20 11:10:53',0,1),
(165,'Triangle noir','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2024/9782702184011-001-X.jpeg?source=web','Livre',9,'2025-10-20',1,'2025-10-20 11:13:32','2025-10-20 11:13:32',0,1),
(166,'La Maison aux lumières','https://media.hachette.fr/fit-in/780x1280/imgArticle/CALMANNLEVY/2023/9782702188613-001-X.jpeg?source=web','Livre',8,'2025-10-20',1,'2025-10-20 11:16:26','2025-10-20 11:16:26',0,1),
(167,'imgtest','/uploads/covers/cover_68f7931ee65fa8.93536188.jpg','Film',2,'2025-10-21',3,'2025-10-21 16:05:19','2025-10-21 16:05:19',0,1),
(176,'waluigi','/uploads/covers/cover_68f8a0015515e1.67441075.png','Jeu',10,'2025-10-22',3,'2025-10-22 11:12:33','2025-10-22 11:12:33',0,1),
(178,'le grand hérisson',NULL,'Livre',22,'2025-10-23',1,'2025-10-23 10:08:55','2025-10-23 10:08:55',0,1),
(179,'le grand hérisson',NULL,'Livre',22,'2025-10-23',1,'2025-10-23 10:09:40','2025-10-23 10:09:40',0,1),
(180,'grand ',NULL,'Livre',17,'2025-10-23',1,'2025-10-23 10:10:25','2025-10-23 10:10:25',0,1);
/*!40000 ALTER TABLE `medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `movies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `realisateur` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `rating` enum('Tout public','Moins de 12 ans','Moins de 16 ans','Moins de 18 ans') NOT NULL,
  `synopsis` text NOT NULL,
  `media_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `movies_media_id_index` (`media_id`),
  CONSTRAINT `movies_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `medias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES
(3,'Jean-Pierre Jeunet',122,2001,'Tout public','À Montmartre, une jeune femme décide de semer de petites joies autour d’elle. Poésie visuelle, destinées croisées et quête intime du bonheur.',43),
(5,'Francis Ford Coppola',175,1972,'Moins de 16 ans','Chronique d’une dynastie mafieuse entre loyauté familiale et violence. Ascension de Michael Corleone et crépuscule de l’innocence.',45),
(6,'James Cameron',195,1997,'Tout public','Romance tragique à bord du Titanic : amour impossible, classes sociales et catastrophe annoncée dans une fresque émouvante.',46),
(7,'Lana & Lilly Wachowski',136,1999,'Moins de 12 ans','Un hacker découvre que sa réalité est une simulation. Arts martiaux, bullet time et questionnement philosophique sur le libre arbitre.',47),
(8,'James Cameron',162,2009,'Tout public','Un soldat paraplégique infiltre un peuple autochtone sur Pandora et remet en cause sa mission. Émerveillement sensoriel et fable écologique.',48),
(10,'Bong Joon-ho',132,2019,'Moins de 12 ans','Une famille modeste s’immisce chez des riches, jusqu’au basculement. Satire sociale tranchante, humour noir et suspense.',50),
(11,'Christopher Nolan',152,2008,'Moins de 12 ans','Batman affronte un Joker anarchique qui veut mettre Gotham à genoux. Duel moral, chaos orchestré et super-héros crépusculaire.',51),
(12,'Damien Chazelle',106,2014,'Tout public','Un batteur ambitieux se heurte à un professeur tyrannique. Tempo infernal, sueur et obsession de la perfection.',52),
(13,'Quentin Tarantino',165,2012,'Moins de 16 ans','Un esclave affranchi traverse le Sud pour sauver sa femme. Western sanglant, verve jubilatoire et réécriture vengeresse.',53),
(14,'George Miller',120,2015,'Moins de 12 ans','Course-poursuite post-apocalyptique où survie, mécaniques folles et sororité s’unissent dans un ballet furieux.',54),
(15,'Pete Docter',96,2009,'Tout public','Un vieil homme s’envole vers ses rêves avec sa maison, escorté d’un scout tenace. Aventure tendre sur le deuil et la transmission.',55),
(16,'Lee Unkrich',105,2017,'Tout public','Au pays des ancêtres, un garçon passionné de musique cherche sa vérité familiale. Couleurs éclatantes et célébration de la mémoire.',56),
(17,'Todd Phillips',122,2019,'Moins de 16 ans','Portrait d’un homme marginal dont la société accentue les fêlures, jusqu’à la naissance d’un criminel iconique.',57),
(18,'Denis Villeneuve',155,2021,'Moins de 12 ans','Lutte pour l’Épice, prophéties et guerres de maisons sur Arrakis. Épopée contemplative et politique.',58),
(19,'Denis Villeneuve',164,2017,'Moins de 12 ans','Un blade runner découvre un secret qui menace l’équilibre entre humains et réplicants. Néon, mystères et mélancolie futuriste.',59),
(20,'Makoto Shinkai',106,2016,'Tout public','Deux adolescents liés par un étrange phénomène temporel voient leurs vies se croiser. Romance, destin et beauté du quotidien.',60),
(23,' Bong Joon-Ho',137,2025,'Tout public','Pour Mickey, mourir est une habitude. Car il est un consommable, engagé volontaire pour tester les dangers auxquels est soumis l’humanité. En cas de décès, il se trouve régénéré avec la plupart de ses souvenirs. Mais que se passerait-il si Mickey 17 survivait à Mickey 18 ?',65),
(24,'Ryan Coogler',131,2025,'Moins de 12 ans','Sud des États-Unis, pendant la ségrégation. Alors qu’ils cherchent à s’affranchir d’un lourd passé, deux frères jumeaux reviennent dans leur ville natale pour repartir à zéro. Mais ils comprennent qu’une puissance maléfique bien plus redoutable guette leur retour avec impatience…',66),
(25,'Mike Flanagan',150,2025,'Tout public','La vie extraordinaire d’un homme ordinaire racontée en trois chapitres. Merci Chuck !',67),
(26,'Guǎn Hǔ',150,2025,'Tout public','Lang revient dans sa ville natale aux portes du désert de Gobi. Alors qu’il travaille pour la patrouille locale chargée de débarrasser la ville des chiens errants, il se lie d’amitié avec l’un d’entre eux. Une rencontre qui va marquer un nouveau départ pour ces deux âmes solitaires...',68),
(27,'Adam Elliot',134,2025,'Tout public','À la mort de son père, la vie heureuse et marginale de Grace Pudel, collectionneuse d’escargots et passionnée de lecture, vole en éclats. Arrachée à son frère jumeau Gilbert, elle atterrit dans une famille d’accueil à l’autre bout de l’Australie. Suspendue aux lettres de son frère, ignorée par ses tuteurs et harcelée par ses camarades de classe, Grace s’enfonce dans le désespoir. Jusqu’à la rencontre salvatrice avec Pinky, une octogénaire excentrique qui va lui apprendre à aimer la vie et à sortir de sa coquille…',69),
(28,'Andrea Arnold ',159,2025,'Moins de 12 ans','À 12 ans, Bailey vit avec son frère Hunter et son père Bug, qui les élève seul dans un squat au nord du Kent. Bug n’a pas beaucoup de temps à leur consacrer et Bailey, qui approche de la puberté, cherche de l’attention et de l’aventure ailleurs.',70),
(31,'Sergio Leone',299,1968,'Tout public','Un chasseur de primes rejoint deux hommes dans une alliance précaire. Leur but ? Trouver un coffre rempli de pièces d\'or dans un cimetière isolé.',88),
(32,'Friedrich Wilhelm Murnau',164,1928,'Tout public','Séduit par une vamp venue de la ville, un fermier tente de noyer sa femme, mais renonce au dernier moment. Apeurée, celle-ci fuit vers la ville. Son mari la suit afin de lui prouver son amour et, après avoir résisté, la jeune femme le pardonne...',89),
(33,'Miloš Forman',253,1976,'Tout public','Pour échapper à la prison, Randall P. McMurphy se fait volontairement interner dans une clinique psychiatrique. Il y découvre injustice et oppression.',90),
(34,'Francis Ford Coppola',267,1979,'Moins de 12 ans','Durant la guerre du Viêt-nam, le capitaine Willard est contraint de mener une mission périlleuse au Cambodge. Accompagné de quatre soldats, il doit mettre fin au commandement du colonel Kurtz, qui utilise des méthodes jugées trop barbares.',91),
(35,'Christopher Nolan',268,2010,'Moins de 12 ans','Dom Cobb est un voleur expérimenté – le meilleur qui soit dans l’art périlleux de l’extraction : sa spécialité consiste à s’approprier les secrets les plus précieux d’un individu, enfouis au plus profond de son subconscient, pendant qu’il rêve et que son esprit est particulièrement vulnérable. Très recherché pour ses talents dans l’univers trouble de l’espionnage industriel, Cobb est aussi devenu un fugitif traqué dans le monde entier qui a perdu tout ce qui lui est cher. Mais une ultime mission pourrait lui permettre de retrouver sa vie d’avant – à condition qu’il puisse accomplir l’impossible : l’inception. Au lieu de subtiliser un rêve, Cobb et son équipe doivent faire l’inverse : implanter une idée dans l’esprit d’un individu. S’ils y parviennent, il pourrait s’agir du crime parfait. Et pourtant, aussi méthodiques et doués soient-ils, rien n’aurait pu préparer Cobb et ses partenaires à un ennemi redoutable qui semble avoir systématiquement un coup d’avance sur eux. Un ennemi dont seul Cobb aurait pu soupçonner l’existence.',92),
(36,'Christopher Nolan',289,2014,'Tout public','Dans un proche futur, la Terre est devenue hostile pour l\'homme. Les tempêtes de sable sont fréquentes et il n\'y a plus que le maïs qui peut être cultivé, en raison d\'un sol trop aride. Cooper est un pilote, recyclé en agriculteur, qui vit avec son fils et sa fille dans la ferme familiale. Lorsqu\'une force qu\'il ne peut expliquer lui indique les coordonnées d\'une division secrète de la NASA, il est alors embarqué dans une expédition pour sauver l\'humanité.\r\n',96),
(37,'Ridley Scott ',275,2000,'Moins de 12 ans','Le général romain Maximus est le plus fidèle soutien de l\'empereur Marc Aurèle, qu\'il a conduit de victoire en victoire. Jaloux du prestige de Maximus, et plus encore de l\'amour que lui voue l\'empereur, le fils de Marc Aurèle, Commode, s\'arroge brutalement le pouvoir, puis ordonne l\'arrestation du général et son exécution. Maximus échappe à ses assassins, mais ne peut empêcher le massacre de sa famille. Capturé par un marchand d\'esclaves, il devient gladiateur et prépare sa vengeance.\r\n',97),
(38,'Joseph Winter et Vanessa Winter',148,2023,'Moins de 16 ans','Une personnalité Internet en disgrâce tente de reconquérir ses abonnés en diffusant en direct une nuit seul dans une maison hantée. Mais quand il énerve accidentellement un esprit vengeur, son grand événement de retour devient un combat en temps réel pour sa vie.',135),
(39,'Frank Darabont',260,1995,'Moins de 12 ans','En 1947, Andy Dufresne, un jeune banquier, est condamné à la prison à vie pour le meurtre de sa femme et de son amant. Ayant beau clamer son innocence, il est emprisonné à Shawshank, le pénitencier le plus sévère de l\'État du Maine. Il y fait la rencontre de Red, un noir désabusé, détenu depuis vingt ans. Commence alors une grande histoire d\'amitié entre les deux hommes…',136),
(40,'Frank Darabont',369,2000,'Moins de 12 ans','Paul Edgecomb, pensionnaire centenaire d’une maison de retraite, est hanté par ses souvenirs. Gardien-chef du pénitencier de Cold Mountain en 1935, il était chargé de veiller au bon déroulement des exécutions des peines capitales, en s’efforçant d’adoucir les derniers moments des condamnés. Parmi eux, se trouvait un colosse du nom de John Coffey, accusé du viol et du meurtre de deux fillettes. Intrigué par cet homme candide et timide, aux dons magiques, Edgecomb va tisser avec lui des liens très forts.',137),
(47,'Ajoute',345,2000,'Moins de 18 ans','grrrrr',153),
(48,'Kubrik',300,1999,'Tout public','yippee',154),
(49,'moi',99,1999,'Tout public','a',167);
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key_name` varchar(190) NOT NULL,
  `value` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES
(1,'borrow.default_duration_days','14','Default borrow duration in days','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(2,'ui.theme','light','User interface theme','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(3,'notifications.email_enabled','true','Send transactional emails','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(4,'borrow.max_renewals','2','Maximum renewals per borrow','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(5,'app.name','MyLibrary','Application name','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(6,'app.locale','fr_FR','Default locale','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(7,'media.default_stock','3','Default stock for new media','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(8,'contact.autoreply_enabled','true','Send auto-reply on contact form','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(9,'pagination.size','20','Items per page','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(10,'uploads.max_size_mb','20','Max upload size in MB','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(11,'security.password_min_len','8','Minimum password length','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(12,'security.rate_limit','100','Requests per minute','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(13,'email.from','noreply@example.com','Default sender email','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(14,'email.smtp_host','smtp.example.com','SMTP host','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(15,'email.smtp_port','587','SMTP port','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(16,'analytics.enabled','false','Enable analytics','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(17,'backup.enabled','true','Enable daily backups','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(18,'backup.hour','3','Backup time (hour)','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(19,'feature.flags.new_ui','false','Feature flag for new UI','2025-10-13 11:14:41','2025-10-13 11:14:41'),
(20,'legal.terms_version','1.0','Current terms version','2025-10-13 11:14:41','2025-10-13 11:14:41');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `idx_users_firstname` (`firstname`),
  KEY `idx_users_lastname` (`lastname`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'John','Doe','john@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(2,'Jane','Smith','jane@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(3,'Admin','User','admin@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',1),
(4,'Alice','Martin','alice.martin@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(5,'Bruno','Dupont','bruno.dupont@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(6,'Claire','Nguyen','claire.nguyen@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(7,'David','Moreau','david.moreau@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(8,'Emma','Leroy','emma.leroy@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(9,'Fabien','Garcia','fabien.garcia@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(10,'Gaelle','Petit','gaelle.petit@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(11,'Hugo','Lambert','hugo.lambert@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(12,'Isabelle','Robert','isabelle.robert@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(13,'Jules','Fontaine','jules.fontaine@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(15,'Lucie','Caron','lucie.caron@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(16,'Mehdi','Roy','mehdi.roy@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(18,'Olivier','Chevalier','olivier.chevalier@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(19,'Pauline','Marchand','pauline.marchand@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-10-13 11:14:41','2025-10-13 11:14:41',0),
(21,'Toto','Toto','toto@gmail.com','$2y$10$3sZ6UjFBa7uLQ8Kzml/4RezYgU/PGEe.fACqImVgY4xvuFGNBoeXm','2025-10-14 14:04:15','2025-10-22 16:25:28',1),
(22,'Rachel','Patoche','jem@gmail.com','$2y$10$GgTKRNPyB9GJ48kN0liMrunKxLMOAqOSfHsdAGoOuD2rCtAxSQCby','2025-10-15 09:12:19','2025-10-22 13:51:03',0),
(23,'Laeti','Laeti','laetitia.quintin@laplateforme.io','$2y$10$zurJaPnxGJBWB4n/TIGOweXrpTaaRK5SdkmRJYB7o8h4TLf1f.o36','2025-10-15 11:46:54','2025-10-15 11:47:31',1),
(26,'Sandrine','Matou','matou@gmail.com','$2y$10$HZPX6DAwYbJ8HcPsU4vDjObhIL5twPfwIcPVTmvqlhUfiOPxrFDz.','2025-10-17 16:03:56','2025-10-17 16:03:56',0),
(27,'Bug','Bug','bug@gmail.com','$2y$10$nhTcOHSiUn8f3dgOIuC/NeEC7clUtu50SXrLVexghiQqvAjkPEmkC','2025-10-20 16:16:45','2025-10-20 16:16:45',0),
(28,'babar','goldorak','babar@gmail.com','$2y$10$QVMrzpIoWOxeLusJdOn65em0vS5QGWNp0Oc6En7kbF6W9TBquut52','2025-10-22 13:46:20','2025-10-22 13:56:37',0),
(29,'Albator','Nounours','nounours@gmail.com','$2y$10$aUxSJ/Payvh5yS4deAMpmeE8QNRpUrrabFAFZ.0j3USHqqFdNrL22','2025-10-22 14:06:10','2025-10-22 14:07:15',0),
(30,'Cousine','Becassine','becassine@gmail.com','$2y$10$K3p4OdIaXKNawaksThdqfejRf7yYPEKpswJvDLAaRpag7m4VpmZcG','2025-10-23 09:10:21','2025-10-23 09:10:21',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-23 11:02:19
