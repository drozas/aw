INSERT INTO User VALUES ("drozas","ee1743530339ae80fc77f129f1e09097");
INSERT INTO User VALUES ("bender","71b475cbc823152cb82e8aef5fc03edf");
INSERT INTO User VALUES ("user01","b75705d7e35e7014521a46b532236ec3");
INSERT INTO User VALUES ("cand01","71b475cbc823152cb82e8aef5fc03edf");

INSERT INTO Candidate VALUES("cand01", "Candidato", "Num1", "11234", "blalblala", "c01@test.com");
INSERT INTO Candidate VALUES("bender", "Bender", "Rodriguez", "11234", "Evergreen Terrace 12", "bender@futurama.net");
INSERT INTO Employeer VALUES("user01", "Joe Industries", "Sesamo street", "11234", "user01@fake.net");
INSERT INTO Verificator VALUES("drozas", "David", "Rozas");


SELECT DISTINCT c.candidateId, c.name, c.lastName
FROM Candidate c, ProfessionalData pd
WHERE (c.candidateId = pd.candidateId AND pd.state='procesing' AND (pd.verificatorId IS NULL OR pd.verificatorId='drozas'))


SELECT DISTINCT c.candidateId, c.name, c.lastName
FROM Candidate c, ProfessionalData pd, AcademicData ad, CandidateReference cr
WHERE (c.candidateId = pd.candidateId AND pd.state='procesing' AND (pd.verificatorId IS NULL OR pd.verificatorId='drozas'))
OR
(c.candidateId = ad.candidateId AND ad.state='procesing' AND (ad.verificatorId IS NULL OR ad.verificatorId='drozas'))
OR
(c.candidateId = cr.candidateId AND cr.state='procesing' AND (cr.verificatorId IS NULL OR cr.verificatorId='drozas'))


SELECT *
FROM ProfessionalData pd, Verificator v
WHERE pd.candidateId ='bender' and (pd.verificatorId IS NULL or pd.verificatorId='drozas')