CREATE TABLE IF NOT EXISTS `service` (
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `localisation` varchar(255) NOT NULL
);

INSERT INTO `service` (`id`, `libelle`, `localisation`) VALUES
(1, 'ophtalmologie', 'Hall B Entree 2'),
(2, 'neurologie', 'Hall B Entree1');

CREATE TABLE IF NOT EXISTS `type_user` (
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL
);

INSERT INTO `type_user` (`id`, `libelle`) VALUES
(1, 'medecin'),
(2, 'patient'),
(3, 'administrateur');

CREATE TABLE IF NOT EXISTS `utilisateur` (
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` char(10) NOT NULL,
  `adresse` varchar(1000) NOT NULL,
  `mTraitant` int(11),
  `num_secu` varchar(15),
  `type` int(11) NOT NULL,
  `service` int(11),
  `pass` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `mail` varchar(100) NOT NULL,
  FOREIGN KEY (mTraitant) REFERENCES utilisateur(id),
  FOREIGN KEY (service) REFERENCES service(id),
  FOREIGN KEY (type) REFERENCES type_user(id)
);

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `adresse`, `num_secu`, `type`, `service`, `pass`, `login`, `mail`) VALUES
(2, 'Ventadour', 'Anna', '0312345678', '1 rue louis pergaud Chalon-sur-saone', '', 1, 1, 'ann', 'anna', 'kiss@gmail.com'),
(5, 'Boucard', 'Mathilde', '0387654321', '1 rue de dijon', '', 2, 2, 'mathi', 'mathi', 'mathi@gmail.com');

CREATE TABLE IF NOT EXISTS `rendez_vous` (
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `presence` tinyint(1) NOT NULL,
  `descriptif` varchar(10000) NOT NULL,
  FOREIGN KEY (id_patient) REFERENCES utilisateur(id),
    FOREIGN KEY (id_medecin) REFERENCES utilisateur(id)
),

CREATE TABLE IF NOT EXISTS `ordonnance` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `medecin` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `lst_medicament` varchar(5000) NOT NULL,
  `date` timestamp NOT NULL,
  `descriptif` varchar(1000) NOT NULL,
  `rdv` int(11) NOT NULL,
    FOREIGN KEY (medecin) REFERENCES utilisateur(id),
      FOREIGN KEY (patient) REFERENCES utilisateur(id),
      FOREIGN KEY (rdv) REFERENCES rendez_vous(id)
),

CREATE TABLE IF NOT EXISTS `occuper` (
  `id_patient` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `pathologie` varchar(1000) NOT NULL,
  `depuis` timestamp NOT NULL,
  `valid` int(11) NOT NULL,
  PRIMARY KEY (id_patient, id_medecin, depuis),
    FOREIGN KEY (id_patient) REFERENCES utilisateur(id),
      FOREIGN KEY (id_medecin) REFERENCES utilisateur(id)
),

CREATE TABLE IF NOT EXISTS `message` (
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `texte` varchar(5000) NOT NULL,
  `destinataire` int(11) NOT NULL,
  `expediteur` int(11) NOT NULL,
  FOREIGN KEY (destinataire) REFERENCES utilisateur(id),
  FOREIGN KEY (expediteur) REFERENCES utilisateur(id)
),