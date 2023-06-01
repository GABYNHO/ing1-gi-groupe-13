def 1
   return 1
def 2
   return 2
def 3
   return 3


import numpy as np
import numpy.linalg as alg

# On considère que le problème est sous forme canonique


def initialiser_matrice():
    n = int(input("entrer le nombre de lignes de votre matrice : "))
    p = int(input("entrer le nombre de colonne de votre matrice : "))
    M = np.zeros((n, p))
    for i in range(n):
        for j in range(p):
            M[i][j] = float(input("Entrer la valeur de M[" + str(i) + "," + str(j) + "] : "))
    return M
def est_positive(M):
    for i in range(len(M[0])):
        if M[0][i] > 0:
            return True

def transvection(M, i, j, y):
    n = len(M[0])
    for k in range(n):
       	 M[i][k] = M[i][k]-y*M[j][k]

def sortrante(M,e):
    p = len(M[0])
    s = 1
    for i in range(2, len(M)):
        if M[s][p-1]/M[s][e] > M[i][p-1]/M[i][e]:
            s = i
    return s
def entrante( M ):
    e = 0
    for i in range(1, len(M[0])-1):
        if M[0][e] < M[0][i]:
            e = i
    return e


def division(M, s, pivot):
    for i in range(len(M[0])):
        M[s][i] = M[s][i] / pivot


def resolution():
    M = [[39,69,0,0,0,0],
         [2.5,7.5,1,0,0,0,240],
         [0.125,0.125,0,1,0,5],
         [17.5,10,0,0,1,595]
         ]
    p = len(M[0])
    b = [2,3,4]
    while est_positive(M):
        e = entrante(M)
        s = sortrante(M, e)
        b[s-1] = e
        pivot = M[s][e]
        division(M, s, pivot)
        for i in range(len(M)):
            if i != s:
                transvection(M, i, s, M[i][e])      
    print(M)
    print("Maximum = "+str((-M[0][p-1])))
    
resolution()
