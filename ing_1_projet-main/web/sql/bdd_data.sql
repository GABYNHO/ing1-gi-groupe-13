-- Compte gestionnaire mdp=cy -- 
INSERT INTO Gestionnaire VALUES ('total@gmail.com','NomGestionnaire','PrenomGestionnaire','0600000000','cy','total','2023-06-01','2023-08-17' );

-- Compte admin mdp=cy --
INSERT INTO Administrateur VALUES ('peio.lou@gmail.com','Loubière','Peio','cy');
INSERT INTO Administrateur VALUES ('yannick.len@gmail.com','Le Nir','Yannick','cy');

INSERT INTO `DataBattle` (`idDB`, `descDB`, `dateD`, `dateF`, `emailGest`) VALUES
(1, 'Data Battle 1', '2022-01-01', '2022-01-15', 'gestionnaire1@example.com'),
(2, 'Data Battle 2', '2023-06-01', '2023-06-08', 'gestionnaire2@example.com');

INSERT INTO `DataChallenge` (`idDC`, `nom`, `emailGest`, `descDC`, `dateD`, `dateF`) VALUES
(1, 'Data Challenge 1', 'gestionnaire1@example.com', 'Description Data Challenge 1', '2022-01-01', '2022-01-31'),
(2, 'Data Challenge 2', 'gestionnaire2@example.com', 'Description Data Challenge 2', '2022-02-01', '2022-02-28'),
(3, 'Data Challenge 3', 'gestionnaire2@example.com', 'Description Data Challenge 3', '2022-03-01', '2022-03-31');

INSERT INTO `Equipe` (`idEquipe`, `emailChef`, `idDC`, `idDB`, `idProjet`, `classementDC`, `classementDB`) VALUES
(1, '', 1, 1, 1, 1, 1),
(2, 'etudiant4@example.com', 2, 2, 2, 1, 5),
(3, 'etudiant6@example.com', 3, 2, 1, 3, 1),
(4, 'etudiant11@example.com', 3, 2, 2, 2, 2),
(5, 'etudiant12@example.com', 3, 2, 2, 4, 4),
(6, 'etudiant16@example.com', 3, 2, 3, 1, 3),
(7, 'test1@example.com', 2, 2, 2, 2, 4),
(8, 'test2@example.com', 2, 2, 1, 3, 4),
(9, 'test3@example.com', 2, 2, 2, 5, 4),
(10, 'test4@example.com', 2, 2, 2, 4, 4);

INSERT INTO `Etudiant` (`email`, `idEquipe`, `nom`, `prenom`, `tel`, `mdp`, `etablissement`, `niveauE`, `ville`, `lien`) VALUES
('etudiant1@example.com', 1, 'Etudiant 1', 'Prenom 1', '123456789', 'cy', 'Etablissement A', 'L1', 'Ville A', 'lien1'),
('etudiant10@example.com', 4, 'Etudiant 10', 'Prenom 10', '987654321', 'cy', 'Etablissement A', 'L2', 'Ville A', 'lien10'),
('etudiant11@example.com', 4, 'Etudiant 11', 'Prenom 11', '123456789', 'cy', 'Etablissement A', 'L1', 'Ville A', 'lien11'),
('etudiant12@example.com', 5, 'Etudiant 12', 'Prenom 12', '987654321', 'cy', 'Etablissement A', 'L2', 'Ville A', 'lien12'),
('etudiant13@example.com', 5, 'Etudiant 13', 'Prenom 13', '123456789', 'cy', 'Etablissement A', 'L1', 'Ville A', 'lien13'),
('etudiant14@example.com', 5, 'Etudiant 14', 'Prenom 14', '987654321', 'cy', 'Etablissement A', 'L2', 'Ville A', 'lien14'),
('etudiant15@example.com', 6, 'Etudiant 15', 'Prenom 15', '123456789', 'cy', 'Etablissement A', 'L1', 'Ville A', 'lien15'),
('etudiant16@example.com', 6, 'Etudiant 16', 'Prenom 16', '987654321', 'cy', 'Etablissement A', 'L2', 'Ville A', 'lien16'),
('etudiant17@example.com', 6, 'Etudiant 17', 'Prenom 17', '987654321', 'cy', 'Etablissement A', 'L2', 'Ville A', 'lien17'),
('etudiant3@example.com', 2, 'Etudiant 3', 'Prenom 3', '123456789', 'cy', 'Etablissement A', 'L1', 'Ville A', 'lien3'),
('etudiant4@example.com', 2, 'Etudiant 4', 'Prenom 4', '987654321', 'cy', 'Etablissement A', 'L2', 'Ville A', 'lien4'),
('etudiant5@example.com', 3, 'Etudiant 5', 'Prenom 5', '123456789', 'cy', 'Etablissement A', 'L1', 'Ville A', 'lien5'),
('etudiant6@example.com', 3, 'Etudiant 6', 'Prenom 6', '987654321', 'cy', 'Etablissement A', 'L2', 'Ville A', 'lien6'),
('etudiant7@example.com', 3, 'Etudiant 7', 'Prenom 7', '123456789', 'cy', 'Etablissement A', 'L1', 'Ville A', 'lien7'),
('etudiant8@example.com', 4, 'Etudiant 8', 'Prenom 8', '987654321', 'cy', 'Etablissement A', 'L2', 'Ville A', 'lien8'),
('etudiant9@example.com', 4, 'Etudiant 9', 'Prenom 9', '123456789', 'cy', 'Etablissement A', 'L1', 'Ville A', 'lien9');

INSERT INTO `Gestionnaire` (`email`, `nom`, `prenom`, `tel`, `mdp`, `entreprise`, `debActi`, `finActi`) VALUES
('gestionnaire1@example.com', 'Gestionnaire 1', 'Prenom 1', '123456789', 'cy', 'Entreprise A', '2022-01-01', '2023-12-31'),
('gestionnaire2@example.com', 'Gestionnaire 2', 'Prenom 2', '987654321', 'cy', 'Entreprise B', '2022-06-01', '2023-05-31');

INSERT INTO `ProjetData` (`idProjet`, `idDC`, `idEquipe`, `descriptionPD`, `imagePD`, `cooCont`, `urlF`, `urlV`, `note`) VALUES
(1, 1, 1, 'Projet Data 1 - DC1 - Equipe 1', 'image1.jpg', 'Coordonnées Contact 1', 'url_fichier1.pdf', 'url_video_youtube', 4),
(2, 1, 1, 'Projet Data 2 - DC1 - Equipe 1', 'image2.jpg', 'Coordonnées Contact 2', 'url_fichier2.pdf', 'url_video_youtube', 3),
(3, 2, 1, 'Projet Data 1 - DC2 - Equipe 1', 'image3.jpg', 'Coordonnées Contact 3', 'url_fichier3.pdf', 'url_video_youtube', 5),
(4, 2, 1, 'Projet Data 2 - DC2 - Equipe 1', 'image4.jpg', 'Coordonnées Contact 4', 'url_fichier4.pdf', 'url_video_youtube', 2),
(5, 2, 1, 'Projet Data 3 - DC2 - Equipe 1', 'image5.jpg', 'Coordonnées Contact 5', 'url_fichier5.pdf', 'url_video_youtube', 4),
(6, 3, 1, 'Projet Data 1 - DC3 - Equipe 1', 'image7.jpg', 'Coordonnées Contact 7', 'url_fichier7.pdf', 'ZSifGMOBhP4', 5),
(7, 3, 1, 'Projet Data 2 - DC3 - Equipe 1', 'image8.jpg', 'Coordonnées Contact 8', 'url_fichier8.pdf', 'uu_B4ywAhOM', 4),
(8, 3, 1, 'Projet Data 3 - DC3 - Equipe 1', 'image9.jpg', 'Coordonnées Contact 9', 'url_fichier9.pdf', 'uu_B4ywAhOM', 2);
