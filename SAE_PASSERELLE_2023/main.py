import math as math
import pandas as pd


# Valeurs optimales selon la demonstration sur ataraxy
def normalize(e, m, mi, ma):
    return 6.22 * (e - m) / (ma - mi) + 10.02


# Calcul la note de l'etudiant pour matiere mat au trimestre tri
# Il faut passer les arguments en chaine de caracteres formates correctement
def calculNote(df, i, mat, tri):

    if mat == "Anglais":
        if df["Langue vivante A scolarité - Libellé 2022/2023"][i] == "Anglais" or df["Langue vivante A scolarité - Libellé 2021/2022"][i] == "Anglais" or df["Langue vivante A scolarité - Libellé 2020/2021"][i] == "Anglais":
            mat = "Langue vivante A"
        else:
            mat = "Langue vivante B"

    e = df["Moyenne du Candidat en " + mat + " pour " + tri][i]
    m = df["Moyenne classe Candidat en " + mat + " pour " + tri][i]
    mi = df["Moyenne Basse Classe du Candidat en " + mat + " pour " + tri][i]
    ma = df["Moyenne Haute Classe du Candidat en " + mat + " pour " + tri][i]

    if math.isnan(e):
        return None
    if math.isnan(m) or math.isnan(mi) or math.isnan(ma):
        return 10.22
    return normalize(e, m, mi, ma)


# Verifie qu'un candidat de filiere generale possede au moins une mathiere de maths
def createOptionDict(df, i):
    options = {}
    annees = ["2020/2021", "2021/2022", "2022/2023"]

    for annee in annees:
        for j in range(1, 5):
            temp = "Option facultative " + str(j) + " Scolarité - Libellé " + annee
            option = df[temp][i]
            options[temp] = (option)

    # for option in options.values():
    #     if "Mathématiques" in option:
    #         return True

    return options


def calculScore(df, i, matrice):
    res = None
    t = 0

    for mat, arr in matrice.items():
        for tri, c in triDict.items():
            note = calculNote(df, i, mat, tri)
            if note is None:
                if mat == "Mathématiques":
                    return None
                else:
                    break
            else:
                # Si le resultat n'a pas ete initialise on s'en occupe
                if res is None:
                    res = 0

                # Si la note est inferieure a la planche on ne classe pas
                if note < matrice[mat]["Planche"]:
                    return None

                coeff = matrice[mat]["Coeff"] * c
                res += note * coeff
                t += coeff

    if t != 0 and res is not None:
        res /= t
    return res

############################################################################

df = pd.read_excel("RT_Anonyme.xlsx")
print(df.info)

# Ecriture des noms de colonnes vers un fichier pour analyse manuelle
column_list = df.columns.tolist()
i = 0
with open("column_names", 'w') as file:
    for column_name in column_list:
        file.write(f"{i} {column_name}\n")
        i += 1

# Conversion de certaines colonnes en donnees numeriques
colonnesNumeriques = df.columns[68:998]
df[colonnesNumeriques] = df[colonnesNumeriques].apply(pd.to_numeric, errors='coerce')

# Coeffs par trimestre
triDict = {
    "trimestre 1": 1,
    "trimestre 2": 1.05,
    "trimestre 3": 1.1,
    "trimestre 1.1": 1.15,
    "trimestre 2.1": 1.2,
    "trimestre 3.1": 1
}

# Matrices pour les coeffs et notes planches
matrice_general = pd.DataFrame(
    {
        'Mathématiques Spécialité': [5, 8],
        'Mathématiques Expertes': [3, 6],
        'Mathématiques Complémentaires': [7, 7],
        'Enseignement scientifique': [4, 7],
        'Numérique et Sciences Informatiques': [6, 8],
        'Anglais': [2, 8],
        'Français': [3, 7]
    },
    index=["Coeff", "Planche"]
)

matrice_sti2d = pd.DataFrame(
    {
        'Mathématiques': [5, 10],
        'Physique-Chimie et Mathématiques': [4, 7],
        'Systemes d\'\'information et numerique': [5, 8],
        'Anglais': [2, 8],
        'Français': [3, 8]
    },
    index=["Coeff", "Planche"]
)

# Nouvelle colonne classement
df["Classement Perso"] = [-1 for x in range(0, 2520)]
# Initialisation du "score" -> moyenne de l'etudiant apres normalisation etc
df["Score"] = [0 for x in range(0, 2520)]

for i in range(len(df)):
    if df["Groupe candidat - Code"][i] == 10600:
        options = createOptionDict(df, i)

        # Si le candidat n'a pas de notes de Maths il n'est pas classe
        if "Mathématiques" not in options:
            df["Score"][i] = None
            df["Classement Perso"][i] = -1

        df["Score"][i] = calculScore(df, i, matrice_general)
    if df["Groupe candidat - Code"][i] == 142310:
        df["Score"][i] = calculScore(df, i, matrice_sti2d)


########################

# On trim les candidats ou score est None
df1 = df[df['Score'].notna()]
df2 = df1[df1['Classement Perso'] != 1]
df_classe = df2.sort_values(by='Score', ascending=False)
df_classe["Classement Perso"] = range(1, len(df_classe) + 1)

print(df_classe)
