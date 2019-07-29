import random

def rnd_key(data, raz, coun1, count2):
	result=""
	for x in range(1,count2+1):
		for y in range(1,coun1+1):
			result+=random.choice(data)
		if x!=count2:
			result+=raz
		else:
			break
	return result