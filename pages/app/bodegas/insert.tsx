import axios from 'axios'
import $rules from '@/assets/rules'
import { Cellar } from '@/types/Cellars'
import { useRouter } from 'next/router'
import {
  Button,
  Card,
  Form,
  Input,
  InputNumber,
  message,
  Space,
  Typography,
} from 'antd'

export default function FormClient() {
  const router = useRouter()
  const [form] = Form.useForm()

  const onSubmit = (data: Cellar) => {
    console.log(data)
    if (router.query.id) {
      axios.put(`/api/warehouses/${router.query.id}`, data)
      message.success('Documento actualizado')
    } else {
      axios.post('/api/warehouses', data)
      message.success('Documento guardado correctamente')
    }
    router.push('/app/bodegas')
  }

  const cssColumnas = 'grid grid-cols-1 md:grid-cols-3 gap-x-6'

  return (
    <Form form={form} layout="vertical" onFinish={onSubmit}>
      <Card>
        <Typography.Title level={4}>Datos</Typography.Title>
        <div className={cssColumnas}>
          <Form.Item name="code" label="Código" rules={[$rules.required()]}>
            <Input placeholder="Ingrese el código" />
          </Form.Item>

          <Form.Item name="name" label="Nombre" rules={[$rules.required()]}>
            <Input placeholder="Ingrese el nombre" />
          </Form.Item>

          <Form.Item name="dimension" label="Dimensión (m3)">
            <InputNumber
              className="w-full"
              placeholder="Ingrese el tamaño de la bodega en metros"
              min={1}
            />
          </Form.Item>
        </div>
      </Card>
      <Card className="mt-4">
        <Typography.Title level={4}>Dirección</Typography.Title>
        <div className={cssColumnas}>
          <Form.Item
            name={['address', 'city']}
            label="Ciudad"
            rules={[$rules.required()]}
          >
            <Input placeholder="Ingrese la ciudad" />
          </Form.Item>
          <Form.Item name={['address', 'parish']} label="Parroquia">
            <Input placeholder="Ingrese la parroquia" />
          </Form.Item>
          <Form.Item name={['address', 'sector']} label="Sector">
            <Input placeholder="Ingrese el sector" />
          </Form.Item>
          <Form.Item name={['address', 'neighborhood']} label="Barrio">
            <Input placeholder="Ingrese el el barrio" />
          </Form.Item>
          <Form.Item name={['address', 'main_street']} label="Calle principal">
            <Input placeholder="Ingrese la calle principal" />
          </Form.Item>
          <Form.Item name={['address', 'back_street']} label="Calle secundaria">
            <Input placeholder="Ingrese la calle secundaria" />
          </Form.Item>
          <Form.Item name={['address', 'house_number']} label="Nº de casa">
            <Input placeholder="Ingrese el número de cada" />
          </Form.Item>
          <Form.Item name={['address', 'reference']} label="Referencia">
            <Input placeholder="Ingrese una referencia" />
          </Form.Item>
        </div>
      </Card>
      <Space className="mt-4 flex justify-end mr-4">
        <Button type="primary" className=" bg-blue-400" htmlType="submit">
          Guardar
        </Button>
        <Button className="ml-3" onClick={() => router.push('/app/bodegas')}>
          Cancelar
        </Button>
      </Space>
    </Form>
  )
}
