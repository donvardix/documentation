import telebot

token=""
bot=telebot.TeleBot(token, threaded=False)

print("1 - Отрпвка сообщений")
print("2 - Получение сообщений")
mod=input("MOD: ")
print(mod)

if int(mod) == 1:
	mess=input("Message: ")
	while mess != "stop":
		bot.send_message(205190213, mess)
		mess=input("Message: ")
	print("Чат закончен")

if int(mod) == 2:
	print("Получение сообщений")
	@bot.message_handler(content_types=['text'])
	def handle_text(message):
	    print("Сообщение: "+message.text)
	bot.polling(none_stop=True, interval=0)