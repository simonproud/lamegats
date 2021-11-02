Изначально взял материалы lordjohn42/megafon-virtual-ats и переписал под себя. Ничего не работает пока и не оттестировано.
# Multiple Virtual ATS CRM Integration

```$l = Lamegats::make(VatsSystem::first());```

`` $params = ['token' => $v->auth_token, 'user' => '79000000000', 'phone' => '79000000001'];``

```$la->getToAts()->makeCall($params)```