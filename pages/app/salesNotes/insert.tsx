import axios from 'axios'
import { useEffect } from 'react'
import $rules from '@/assets/rules'
import { User } from '@/types/User'
import { useRouter } from 'next/router'
import {
  Button,
  Card,
  Form,
  Input,
  InputNumber,
  message,
  Space,
  Upload,
} from 'antd'

export default function FormClient() {
  const router = useRouter()
  const [form] = Form.useForm()

  useEffect(() => {
    if (router.query.id) {
      axios.get(`/api/sales-note/${router.query.id}`).then(({ data }) => {
        form.setFieldsValue(data)
      })
    }
  }, [router.query.id])

  const onSubmit = (data: User) => {
    console.log(data)
    if (router.query.id) {
      axios.put(`/api/sales-note/${router.query.id}`, data)
      message.success('Documento actualizado')
    } else {
      axios.post('/api/sales-note', data)
      message.success('Documento guardado correctamente')
    }
    router.push('/app/productos')
  }

  const cssColumnas = 'grid grid-cols-1 md:grid-cols-3 gap-x-6'

  return (
    <Form form={form} layout="vertical" onFinish={onSubmit}>
      <Card>
        <div className={cssColumnas}>
          <Form.Item
            name="invoice_number"
            label="Nº comprobante"
            rules={[$rules.required()]}
          >
            <Input placeholder="Ingrese el número de comprobante" />
          </Form.Item>

          <Form.Item name="code" label="Código" rules={[$rules.required()]}>
            <Input placeholder="Ingrese un código" />
          </Form.Item>
          <Form.Item name="client" label="Cliente">
            <Input placeholder="Ingrese un titulo" />
          </Form.Item>
        </div>
      </Card>
      <Space className="mt-4 flex justify-end mr-4">
        <Button type="primary" className=" bg-blue-400" htmlType="submit">
          Guardar
        </Button>
        <Button className="ml-3" onClick={() => router.push('/app/productos')}>
          Cancelar
        </Button>
      </Space>
    </Form>
  )
}
