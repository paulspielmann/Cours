# Echange la position des lignes aux indices a et b
def echangeLigne(mat, a, b):
    temp = mat[a]
    mat[a] = mat[b]
    mat[b] = temp
    return mat


# Multiplie le vecteur a l'index i par un scalaire x
def multLigne(mat, i, x, d):
    for j in range(len(mat[i])):
        if d:
            mat[i][j] /= x
        else:
            mat[i][j] *= x
    return mat


def gaussianElim(mat):
    nbLignes = len(mat)
    nbCols = len(mat[0])
    lignePivot = 0

    for col in range(nbCols):
        pivot = mat[lignePivot][col]
        lignePivotIndex = lignePivot
        i = lignePivot + 1

        for i in range(lignePivot + 1, nbLignes):
            if abs(mat[i][col]) > abs(pivot):
                pivot = mat[i][col]
                lignePivotIndex = i

        echangeLigne(mat, lignePivot, lignePivotIndex)

        # On mets le pivot a 1
        pivot = mat[lignePivot][col]
        multLigne(mat, lignePivot, pivot, True)

        for i in range(nbLignes):
            if i != lignePivot:
                scalaire = mat[i][col]
                for j in range(col, nbCols):
                    mat[i][j] = mat[i][j] - scalaire * mat[lignePivot][j]

        lignePivot += 1

        if lignePivot >= nbLignes:
            break

    return mat
