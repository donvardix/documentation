import urllib.request
import os

def LoadFile(url):
	filename=os.path.basename(url) #Достает название файла. (Например: "http://www.site.ru:/images/abc.png", получит "abc.png"
	urllib.request.urlretrieve(url, filename) #Скачивание файла
	os.startfile(filename) #Запуск файла