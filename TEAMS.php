

<?php
$nome = "claudio eeeeeeeeeeeeeeeeeeeeeeeeeee";

 define('TEAMS_WEBHOOK', 'https://outlook.office.com/webhook/c0df5b03-e62b-4a64-93ff-f093fc41f1c2@407e34f8-c571-4354-9ab3-de195ab979a6/IncomingWebhook/714f5002fff94c35a62731201a74649f/f69d8532-4ecd-4add-9072-a2c3e06820ef');
$JTXT = '{
	  "@context": "https://schema.org/extensions",
	  "@type": "MessageCard",
	  "themeColor": "0072C6",
	  "title": "Martt é um Robô do QRCODE KVM",
	  "text": "Está mensagem foi enviada porque alguem realizou um acesso ao sistema{{<php echo $nome ?>}}",
	  "potentialAction": [
	    {
	      "@type": "ActionCard",
	      "name": "Send Feedback",
	      "inputs": [
	        {
	          "@type": "TextInput",
	          "id": "feedback",
	          "isMultiline": true,
	          "title": "Let us know what you think about Actionable Messages"
	        }
	      ],
	      
	    },
	    
	  ]
	}';



  // Usando o curl para enviar
  $c = curl_init(TEAMS_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $JTXT."TESTANDO");
  curl_exec($c);
  curl_close($c);



 ?>