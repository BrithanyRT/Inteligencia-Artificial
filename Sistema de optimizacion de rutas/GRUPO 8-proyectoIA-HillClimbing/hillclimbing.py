from string import Template
from unittest import result

import math
import random

def distancia(coord1,coord2):
  lat1=coord1[0]
  lon1=coord1[1]
  lat2=coord2[0]
  lon2=coord2[1]
  return math.sqrt((lat1-lat2)**2+(lon1-lon2)**2)

#Calcular distancia cubierta por una ruta
def evalua_ruta(ruta):
  total=0
  for i in range(0,len(ruta)-1):
    ciudad1=ruta[i]
    ciudad2=ruta[i+1]
    total=total+distancia(coord[ciudad1],coord[ciudad2])
    ciudad1=ruta[i+1]
    ciudad2=ruta[0]
    total=total+distancia(coord[ciudad1],coord[ciudad2])
  return total

def i_hill_climbing():
  #crear ruta inicial aleatoria
  ruta=[]
  for ciudad in coord:
    ruta.append(ciudad)
  mejor_ruta=ruta[:]
  max_iteraciones=15

  while max_iteraciones>0:
    mejora=True
    #Generamos una nueva ruta aleatoria
    random.shuffle(ruta)
    while mejora:
      mejora=False
      dist_actual=evalua_ruta(ruta)
      #evaluar vecinos
      for i in range(0,len(ruta)):
        if mejora:
          break
        for j in range(0,len(ruta)):
          if i != j:
            ruta_tmp=ruta[:]
            ciudad_tmp=ruta_tmp[i]
            ruta_tmp[i]=ruta_tmp[j]
            ruta_tmp[j]=ciudad_tmp
            dist=evalua_ruta(ruta_tmp)
            if dist<dist_actual:
              #Encontrado vecino que mejora el resultado
              mejora=True
              ruta=ruta_tmp[:]
              break
    max_iteraciones=max_iteraciones-1
    if evalua_ruta(ruta)<evalua_ruta(mejor_ruta):
      mejor_ruta=ruta[:]
  return mejor_ruta


coord={
    'Civa Javier Prado PER-LIM':[-12.063321304701033, -77.0334496591447],
    'Civa 28 de Julio PER-LIM':[-12.063226877463787, -77.03352476099145],
    'Civa Atocongo PER-LIM':[-12.155972037727391, -76.9655953744843],
    'Terminal Terrestre Plaza Norte PER-LIM':[-12.005051785087128, -77.05494476760562],
    'Civa Arequipa Central PER-ARE':[-16.42303396711053, -71.5453360854306],
    'Civa Arequipa Camana PER-ARE':[-16.402741432272975, -71.51235965474616],
    'Civa Piura Loreto PER-PIU':[-5.201091472336525, -80.63118770328701],
    'Civa Talara PER-PIU':[-4.586560718171606, -81.27041074562112],
    
    
    'Civa Abancay PER-APU':[-13.639179280953257, -72.88528518972556],
    'Civa Terminal Bagua Grande PER-AMA':[-5.610295414784535, -78.43606746099624],
    'Civa Terminal Cajamarca PER-CAJ':[-7.17104578365114, -78.50138495686839],
    'Civa Terminal Bolognesi Chiclayo PER-CHI':[-6.775742750626063, -79.83828664670624],
    'Civa Terminal Cusco PER-CUS':[-13.533136022933917, -71.97171081885351],
    'Civa Terminal Huaraz PER-HUA':[-9.525636997019953, -77.52745021214375],
    'Civa Terminal Ica PER-ICA':[-14.063957987457615, -75.73318988968508]
}

ruta=i_hill_climbing()
r=print(ruta)
d=print(str(evalua_ruta(ruta)))

