@component('mail::message')
# Hello {{ $feedback->user_name }},

We have received your feedback:

**"{{ $feedback->message }}"**

---

### **Our Reply:**

{{ $reply }}

Thanks for reaching out!  
Warm regards,  
**SmartShop Admin**
@endcomponent
