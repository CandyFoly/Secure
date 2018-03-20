-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 16 Mars 2018 à 08:25
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `hopital`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `texte` varchar(5000) NOT NULL,
  `destinataire` int(11) NOT NULL,
  `expediteur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `occuper`
--

CREATE TABLE IF NOT EXISTS `occuper` (
  `id_patient` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `pathologie` varchar(1000) NOT NULL,
  `depuis` timestamp NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ordonnace`
--

CREATE TABLE IF NOT EXISTS `ordonnace` (
  `id` int(11) NOT NULL,
  `medecin` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `lst_medicament` varchar(5000) NOT NULL,
  `date` timestamp NOT NULL,
  `descriptif` varchar(1000) NOT NULL,
  `rdv` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE IF NOT EXISTS `rendez_vous` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `presence` tinyint(1) NOT NULL,
  `descriptif` varchar(10000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
`id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `localisation` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `libelle`, `localisation`) VALUES
(1, 'ophtalmologie', 'Hall B Entree 2'),
(2, 'neurologie', 'Hall B Entree1');

-- --------------------------------------------------------

--
-- Structure de la table `type_user`
--

CREATE TABLE IF NOT EXISTS `type_user` (
`id` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_user`
--

INSERT INTO `type_user` (`id`, `libelle`) VALUES
(1, 'medecin'),
(2, 'patient'),
(3, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
`id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` char(10) NOT NULL,
  `adresse` varchar(1000) NOT NULL,
  `mTriatant` varchar(60) NOT NULL,
  `num_secu` varchar(15) NOT NULL,
  `type` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `adresse`, `mTriatant`, `num_secu`, `type`, `service`, `pass`, `login`, `mail`) VALUES
(2, 'Ventadour', 'Anna', '0312345678', '1 rue louis pergaud Chalon-sur-saone', '', '', 1, 1, 'ann', 'anna', 'kiss@gmail.com'),
(5, 'Boucard', 'Mathilde', '0387654321', '1 rue de dijon', '', '', 2, 2, 'mathi', 'mathi', 'mathi@gmail.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`), ADD KEY `destinataire` (`destinataire`), ADD KEY `expediteur` (`expediteur`);

--
-- Index pour la table `occuper`
--
ALTER TABLE `occuper`
 ADD KEY `id_medecin` (`id_medecin`), ADD KEY `id_patient` (`id_patient`);

--
-- Index pour la table `ordonnace`
--
ALTER TABLE `ordonnace`
 ADD KEY `medecin` (`medecin`), ADD KEY `patient` (`patient`), ADD KEY `rdv` (`rdv`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
 ADD PRIMARY KEY (`id`), ADD KEY `id_medecin` (`id_medecin`), ADD KEY `id_patient` (`id_patient`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_user`
--
ALTER TABLE `type_user`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`id`), ADD KEY `type` (`type`), ADD KEY `service` (`service`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `type_user`
--
ALTER TABLE `type_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
